@extends('layouts.default')

@section('content')
<div class="admin-wrapper">
  
  <h2 class="admin-title">Admin</h2>

  <form method="GET" action="{{ route('admin.dashboard') }}" class="admin-filter-form">
    <input type="text" name="keyword" class="admin-input" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">

    <select name="gender" class="admin-select">
      <option value="" {{ request('gender') === null || request('gender') === '' ? 'selected' : '' }}>性別</option>
      <option value="all" {{ request('gender') === 'all' ? 'selected' : '' }}>全て</option>
      <option value="男性" {{ request('gender') === '男性' ? 'selected' : '' }}>男性</option>
      <option value="女性" {{ request('gender') === '女性' ? 'selected' : '' }}>女性</option>
      <option value="その他" {{ request('gender') === 'その他' ? 'selected' : '' }}>その他</option>
    </select>

    <select name="contact_type" class="admin-select">
      <option value="">お問い合わせの種類</option>
      <option value="交換" {{ request('contact_type') === '交換' ? 'selected' : '' }}>商品の交換について</option>
      <option value="返品" {{ request('contact_type') === '返品' ? 'selected' : '' }}>商品の返品について</option>
    </select>

    <input type="date" name="date" class="admin-select" value="{{ request('date') }}">

    <button type="submit" class="admin-button search">検索</button>
    <a href="{{ route('admin.dashboard') }}" class="admin-button reset">リセット</a>
  </form>

  <form method="GET" action="{{ route('admin.export') }}">
    <input type="hidden" name="keyword" value="{{ request('keyword') }}">
    <input type="hidden" name="gender" value="{{ request('gender') }}">
    <input type="hidden" name="contact_type" value="{{ request('contact_type') }}">
    <input type="hidden" name="date" value="{{ request('date') }}">
    <button type="submit" class="admin-export-button">エクスポート</button>
  </form>

  <table class="admin-table">
    <thead>
      <tr>
        <th>お名前</th>
        <th>性別</th>
        <th>メールアドレス</th>
        <th>お問い合わせの種類</th>
        <th>日付</th>
        <th>詳細</th>
      </tr>
    </thead>

    <tbody>
      @forelse ($contacts as $contact)
        <tr>
          <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
          <td>
            @php
              $genderMap = [1 => '男性', 2 => '女性', 3 => 'その他'];
            @endphp
            {{ $genderMap[$contact->gender] ?? '不明' }}
          </td>
          <td>{{ $contact->email }}</td>
          <td>{{ $contact->contact_type }}</td>
          <td>{{ $contact->created_at->format('Y-m-d') }}</td>
          <td>
            <button class="detail-button" data-id="{{ $contact->id }}">詳細</button>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6">該当するデータが見つかりませんでした。</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div class="pagination-wrapper">
    {{ $contacts->links() }}
  </div>

  <!-- モーダルウィンドウ構造 -->
  <div id="detailModal" class="modal" style="display:none;">
    <div class="modal-content">
      <span class="modal-close">&times;</span>
      <div id="modal-body">
        <p>読み込み中...</p>
      </div>
      <button id="deleteButton" data-id="">削除</button>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('detailModal');
  const modalBody = document.getElementById('modal-body');
  const deleteButton = document.getElementById('deleteButton');
  const closeButton = modal.querySelector('.modal-close');

  document.querySelectorAll('.detail-button').forEach(button => {
    button.addEventListener('click', function () {
      const contactId = this.getAttribute('data-id');
      modal.style.display = 'flex';
      modalBody.innerHTML = '<p>読み込み中...</p>';
      deleteButton.setAttribute('data-id', contactId);

      fetch(`/admin/contact/${contactId}`)
        .then(response => response.json())
        .then(data => {
          modalBody.innerHTML = `
            <p><strong>名前：</strong>${data.last_name} ${data.first_name}</p>
            <p><strong>性別：</strong>${data.gender === 1 ? '男性' : data.gender === 2 ? '女性' : 'その他'}</p>
            <p><strong>メール：</strong>${data.email}</p>
            <p><strong>お問い合わせ種類：</strong>${data.contact_type}</p>
            <p><strong>日付：</strong>${data.created_at}</p>
          `;
        });
    });
  });

  closeButton.addEventListener('click', () => {
    modal.style.display = 'none';
    modalBody.innerHTML = '';
  });

  window.addEventListener('click', e => {
    if (e.target === modal) {
      modal.style.display = 'none';
      modalBody.innerHTML = '';
    }
  });

  deleteButton.addEventListener('click', () => {
    const id = deleteButton.getAttribute('data-id');
    if (!confirm('本当に削除しますか？')) return;

    fetch(`/admin/contact/${id}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Accept': 'application/json',
      }
    }).then(response => {
      if (response.ok) {
        alert('削除しました');
        modal.style.display = 'none';
        location.reload();
      } else {
        alert('削除に失敗しました');
      }
    });
  });
});
</script>



@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection
