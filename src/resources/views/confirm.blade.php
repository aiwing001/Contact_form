@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h2>Confirm</h2>
    </div>
    <form class="form" action="/contacts" method="POST">
    @csrf

        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        <input type="text" value="{{ $request->last_name }}　{{ $request->first_name }}" readonly>
                        <input type="hidden" name="last_name" value="{{ $request->last_name }}">
                        <input type="hidden" name="first_name" value="{{ $request->first_name }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        <input type="text" value="{{ [
                            1 => '男性',
                            2 => '女性',
                            3 => 'その他'
                            ][$request->gender] ?? '' }}" readonly>
                        <input type="hidden" name="gender" value="{{ $request->gender }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        <input type="email" name="email" value="{{ $request->email }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        <input type="text" value="{{ $request->tel1 }}{{ $request->tel2 }}{{ $request->tel3 }}" readonly>
                        <input type="hidden" name="tel1" value="{{ $request->tel1 }}">
                        <input type="hidden" name="tel2" value="{{ $request->tel2 }}">
                        <input type="hidden" name="tel3" value="{{ $request->tel3 }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        <input type="text" name="address" value="{{ $request->address }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <input type="text" name="building" value="{{ $request->building }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        <input type="text" value="{{ [
                            1 => '商品のお届けについて',
                            2 => '商品の交換について',
                            3 => '商品トラブル',
                            4 => 'ショップへのお問い合わせ',
                            5 => 'その他'
                            ][$request->category_id] ?? '' }}" readonly>
                        <input type="hidden" name="category_id" value="{{ $request->category_id }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        <textarea name="detail" rows="4" readonly>{{ $request->detail }}</textarea>
                    </td>
                </tr>
            </table>
        </div>
        <div class="form__button">
            <button class="form__button-submit form__button-submit--send" name="action" type="submit" value="submit">送信</button>
            <a href="javascript:history.back()" class="form__button-submit form__button-submit--back">修正</a>
        </div>
    </form>
</div>
@endsection