<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Furniture;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with('user');

        if ($request->filled('start_date')) {
            $query->whereDate(
                'transaction_date',
                '>=',
                $request->start_date
            );
        }

        if ($request->filled('end_date')) {
            $query->whereDate(
                'transaction_date',
                '<=',
                $request->end_date
            );
        }

        $transactions = $query
    ->latest()
    ->paginate(10)
    ->withQueryString();

        return view('transactions.index', compact('transactions'));
        
    }

    public function paymentForm($id)
{
    $transaction = Transaction::findOrFail($id);

    return view('transactions.payment', compact('transaction'));
}

public function processPayment(Request $request, $id)
{
    $transaction = Transaction::findOrFail($id);

    $request->validate([
        'amount' => 'required'
    ]);

    $amount = (int) str_replace('.', '', $request->amount);

    $transaction->paid += $amount;

    $transaction->remaining_debt -= $amount;

    // LUNAS
    if ($transaction->remaining_debt <= 0) {

        $transaction->change =
            abs($transaction->remaining_debt);

        $transaction->remaining_debt = 0;

        $transaction->payment_status = 'paid';
    }

    $transaction->save();

    return redirect()
        ->route('transactions.index')
        ->with('success', 'Pembayaran cicilan berhasil');
}
    public function create()
    {
        $furniture = Furniture::where('is_active', true)->get();

        $suppliers = Supplier::where('is_active', true)->get();

        $cart = session()->get('cart', []);

        $furnitureData = [];

        foreach ($furniture as $item) {

            $furnitureData[] = [
                'id' => $item->id,
                'name' => $item->name,
                'code' => $item->code,
                'selling_price' => (int) $item->selling_price,
                'stock' => $item->stock,
                'image' => $item->image
                    ? asset($item->image)
                    : null,
            ];
        }

        return view('transactions.create', [
            'furniture' => $furnitureData,
            'suppliers' => $suppliers,
            'cart' => $cart
        ]);
    }

    public function addToCart($id, $quantity)
    {
        $furniture = Furniture::find($id);

        if (!$furniture) {
            return redirect()
                ->back()
                ->with('error', 'Produk tidak ditemukan');
        }

        $cart = session()->get('cart', []);

        $price = (int) $furniture->selling_price;

        if (isset($cart[$id])) {

            $cart[$id]['quantity'] += $quantity;

        } else {

            $cart[$id] = [

                'furniture_id' => $furniture->id,

                'name' => $furniture->name,

                'price' => $price,

                'quantity' => $quantity,

                'image' => $furniture->image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()
            ->route('transactions.create')
            ->with('success', 'Produk ditambahkan');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            unset($cart[$id]);

            session()->put('cart', $cart);
        }

        return redirect()
            ->route('transactions.create')
            ->with('success', 'Produk dihapus');
    }

    public function clearCart()
    {
        session()->forget('cart');

        return redirect()
            ->route('transactions.create')
            ->with('success', 'Keranjang dikosongkan');
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {

            return redirect()
                ->back()
                ->with('error', 'Keranjang belanja kosong!');
        }

        try {

            DB::beginTransaction();

            // ======================
            // SUBTOTAL
            // ======================

            $subtotal = 0;

            foreach ($cart as $item) {

                $price = (int) $item['price'];

                $qty = (int) $item['quantity'];

                $subtotal += ($price * $qty);
            }

            // ======================
            // DISKON
            // ======================

            $discount = (int) preg_replace(
                '/[^0-9]/',
                '',
                $request->discount ?? 0
            );

            // ======================
            // TOTAL
            // ======================

            $total = $subtotal - $discount;

            if ($total < 0) {
                $total = 0;
            }

            // ======================
            // PAYMENT
            // ======================

            $paymentMethod = $request->payment_method ?? 'cash';

            $paid = (int) preg_replace(
                '/[^0-9]/',
                '',
                $request->paid ?? 0
            );

            $remainingDebt = 0;

            $paymentStatus = 'paid';

            // ======================
            // DP
            // ======================

            if ($paymentMethod == 'dp') {

                $dpAmount = (int) preg_replace(
                    '/[^0-9]/',
                    '',
                    $request->dp_amount ?? 0
                );

                $paid = $dpAmount;

                $remainingDebt = $total - $dpAmount;

                if ($remainingDebt < 0) {
                    $remainingDebt = 0;
                }

                $paymentStatus =
                    $remainingDebt > 0
                        ? 'down_payment'
                        : 'paid';
            }

            // ======================
            // KEMBALIAN
            // ======================

            $change = $paid - $total;

            if ($change < 0) {
                $change = 0;
            }

            // ======================
            // CREATE TRANSACTION
            // ======================

            $transaction = Transaction::create([

                'invoice_number' => 'INV/' . date('YmdHis'),

                'user_id' => auth()->id() ?? 1,

                'customer_name' =>
                    $request->customer_name ?? 'Umum',

                'type' => 'cash',

                'subtotal' => $subtotal,

                'discount' => $discount,

                'total' => $total,

                'paid' => $paid,

                'change' => $change,

                'payment_method' => $paymentMethod,

                'payment_status' => $paymentStatus,

                'remaining_debt' => $remainingDebt,

                'status' => 'completed',

                'transaction_date' => now(),
            ]);

            // ======================
            // DETAIL TRANSAKSI
            // ======================

            foreach ($cart as $item) {

                $furniture = Furniture::find(
                    $item['furniture_id']
                );

                if (!$furniture) {
                    continue;
                }

                $price = (int) $item['price'];

                $qty = (int) $item['quantity'];

                $detailSubtotal = $price * $qty;

                TransactionDetail::create([

                    'transaction_id' => $transaction->id,

                    'furniture_id' => $item['furniture_id'],

                    'quantity' => $qty,

                    'price' => $price,

                    'base_price' =>
                        $furniture->purchase_price ?? $price,

                    'subtotal' => $detailSubtotal,
                ]);

                // ======================
                // KURANGI STOK
                // ======================

                $furniture->stock -= $qty;

                if ($furniture->stock < 0) {
                    $furniture->stock = 0;
                }

                $furniture->save();
            }

            DB::commit();

            session()->forget('cart');

            return redirect()
                ->route(
                    'transactions.invoice',
                    $transaction->id
                )
                ->with(
                    'success',
                    'Transaksi berhasil!'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Error: ' . $e->getMessage()
                );
        }
    }

    public function invoice($id)
    {
        $transaction = Transaction::with([
            'details',
            'details.furniture',
            'user'
        ])->find($id);

        if (!$transaction) {
            abort(404);
        }

        return view(
            'transactions.invoice',
            compact('transaction')
        );
    }

    public function show(Transaction $transaction)
    {
        return view(
            'transactions.show',
            compact('transaction')
        );
    }

    public function edit($id)
    {
        $transaction = Transaction::with(
            'details.furniture'
        )->findOrFail($id);

        $furniture = Furniture::where(
            'is_active',
            true
        )->get();

        $suppliers = Supplier::where(
            'is_active',
            true
        )->get();

        return view(
            'transactions.edit',
            compact(
                'transaction',
                'furniture',
                'suppliers'
            )
        );
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        foreach ($transaction->details as $detail) {

            $furniture = Furniture::find(
                $detail->furniture_id
            );

            $furniture->stock += $detail->quantity;

            $furniture->save();
        }

        $transaction->details()->delete();

        $transaction->delete();

        return redirect()
            ->route('transactions.index')
            ->with(
                'success',
                'Transaksi berhasil dihapus!'
            );
    }
}