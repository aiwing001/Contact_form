@extends('layouts.auth')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin-form__content">
    <div class="admin-form__heading">
        <h2>Admin</h2>
    </div>

    <form class="search-form" action="/search" method="GET">
        <div class="search-form__item">
            <input
                class="search-form__item-input"
                type="text"
                name="keyword"
                placeholder="名前やメールアドレスを入力してください"
                value="{{ request('keyword') }}">
            <select class="search-form__item-select--gender" name="gender">
                <option value="">性別</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>
            <select class="search-form__item-select--category_id" name="category_id">
                <option value="">お問い合わせの種類</option>
                <option value="1" {{ request('category_id') == '1' ? 'selected' : '' }}>1.商品のお届けについて</option>
                <option value="2" {{ request('category_id') == '2' ? 'selected' : '' }}>2.商品の交換について</option>
                <option value="3" {{ request('category_id') == '3' ? 'selected' : '' }}>3.商品トラブル</option>
                <option value="4" {{ request('category_id') == '4' ? 'selected' : '' }}>4.ショップへのお問い合わせ</option>
                <option value="5" {{ request('category_id') == '5' ? 'selected' : '' }}>5.その他</option>
            </select>
            <input
                class="search-form__item-date"
                type="date"
                name="date"
                value="{{ request('date') }}">
        </div>
        <div class="search-form__button">
            <button class="search-form__button-submit--search" type="submit">検索</button>
            <a href="/reset" class="search-form__button-submit--reset">リセット</a>
        </div>
    </form>
</div>

<div class="admin-table">
    <div class="admin-table-header">
        <div class="admin-table-header__left">
            <a class="admin-table-export-button" href="/export?{{ request()->getQueryString() }}">エクスポート</a>
        </div>
        <div class="admin-table-header__right">
            {{ $items->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <div class="admin-table__wrap">
        <table class="admin-table__inner">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->last_name }} {{ $item->first_name }}</td>
                    <td>@if ($item->gender == 1)
                            男性
                        @elseif ($item->gender == 2)
                            女性
                        @else
                            その他
                        @endif
                    </td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->category->content }}</td>
                    <td>
                        <button
                            class="details__button"
                            type="button"
                            data-id="{{ $item->id }}"
                            data-name="{{ $item->last_name }} {{ $item->first_name }}"
                            data-gender="{{ $item->gender == 1 ? '男性' : ($item->gender == 2 ? '女性' : 'その他') }}"
                            data-email="{{ $item->email }}"
                            data-tel="{{ $item->tel }}"
                            data-address="{{ $item->address }}"
                            data-building="{{ $item->building }}"
                            data-type="{{ $item->category->content }}"
                            data-content="{{ $item->detail }}"
                            >
                            詳細
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal" id="detailModal">
        <div class="modal__content">
            <button class="modal__close" type="button">×</button>
                <p><span class="label">お名前</span><span id="modalName"></span></p>
                <p><span class="label">性別</span><span id="modalGender"></span></p>
                <p><span class="label">メールアドレス</span><span id="modalEmail"></span></p>
                <p><span class="label">電話番号</span><span id="modalTel"></span></p>
                <p><span class="label">住所</span><span id="modalAddress"></span></p>
                <p><span class="label">建物名</span><span id="modalBuilding"></span></p>
                <p><span class="label">お問い合わせの種類</span><span id="modalType"></span></p>
                <p><span class="label">お問い合わせ内容</span><span id="modalContent"></span></p>
            <form id="deleteForm" action="/delete" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" id="deleteId">
                <button class="modal__delete-button" type="submit">削除</button>
            </form>
        </div>
    </div>
</div>
<script>
    const modal = document.getElementById('detailModal');
    const buttons = document.querySelectorAll('.details__button');
    const closeBtn = modal.querySelector('.modal__close');
    const deleteForm = document.getElementById('deleteForm');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('modalName').textContent = button.dataset.name;
            document.getElementById('modalGender').textContent = button.dataset.gender;
            document.getElementById('modalEmail').textContent = button.dataset.email;
            document.getElementById('modalType').textContent = button.dataset.type;
            document.getElementById('modalContent').textContent = button.dataset.content;
            document.getElementById('modalTel').textContent = button.dataset.tel;
            document.getElementById('modalAddress').textContent = button.dataset.address;
            document.getElementById('modalBuilding').textContent = button.dataset.building;
            document.getElementById('deleteId').value = button.dataset.id;
            modal.style.display = 'flex';
        });
    });

    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });
</script>
@endsection