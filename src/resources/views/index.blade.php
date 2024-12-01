@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form">
    <div class="contact-form__title">
        <p>Contact</p>
    </div>
    <div class="contact-table">
        <!-- フォームにIDを追加 -->
        <form action="/confirm" method="post" id="contact-form">
            @csrf
            <table class="contact-table__inner">
                <!-- お名前 -->
                <tr class="contact-table__row">
                    <th class="contact-table__header">お名前<span>※</span></th>
                    <td class="contact-table__input-name">
                        <input class="contact-table__input-last-name" type="text" name="last-name" value="{{ old('last-name', $contact['last-name'] ?? '') }}" placeholder="例：山田">
                        <input class="contact-table__input-first-name" type="text" name="first-name" value="{{ old('first-name', $contact['first-name'] ?? '') }}" placeholder="例：太郎">
                    </td>
                </tr>

                <!-- 性別 -->
                <tr class="contact-table__row">
                    <th class="contact-table__header">性別<span>※</span></th>
                    <td class="contact-table__input-gender">
                        <div class="contact-table__gender">
                            <label>
                                <input type="radio" name="gender" value="男性" {{ old('gender', $contact['gender'] ?? '') == '男性' ? 'checked' : '' }}>男性
                            </label>
                            <label>
                                <input type="radio" name="gender" value="女性" {{ old('gender', $contact['gender'] ?? '') == '女性' ? 'checked' : '' }}>女性
                            </label>
                            <label>
                                <input type="radio" name="gender" value="その他" {{ old('gender', $contact['gender'] ?? '') == 'その他' ? 'checked' : '' }}>その他
                            </label>
                        </div>
                    </td>
                </tr>

                <!-- メールアドレス -->
                <tr class="contact-table__row">
                    <th class="contact-table__header">メールアドレス<span>※</span></th>
                    <td class="contact-table__input-email">
                        <input type="email" name="email" value="{{ old('email', $contact['email'] ?? '') }}" placeholder="例：test@example.com" class="contact-table__input-email-content">
                    </td>
                </tr>

                <!-- 電話番号 -->
                <tr class="contact-table__row">
                    <th class="contact-table__header">電話番号<span>※</span></th>
                    <td class="contact-table__input-tel">
                        <input class="contact-table__tel" type="text" id="tel1" name="tel1" maxlength="3" size="4" pattern="\d{3}" required placeholder="090" value="{{ old('tel1', $contact['tel1'] ?? '') }}"> -
                        <input class="contact-table__tel" type="text" id="tel2" name="tel2" maxlength="4" size="5" pattern="\d{4}" required placeholder="1234" value="{{ old('tel2', $contact['tel2'] ?? '') }}"> -
                        <input class="contact-table__tel" type="text" id="tel3" name="tel3" maxlength="4" size="5" pattern="\d{4}" required placeholder="5678" value="{{ old('tel3', $contact['tel3'] ?? '') }}">
                    </td>
                </tr>

                <!-- 住所 -->
                <tr class="contact-table__row">
                    <th class="contact-table__header">住所<span>※</span></th>
                    <td class="contact-table__input-address">
                        <input class="contact-table__address" type="text" name="address" value="{{ old('address', $contact['address'] ?? '') }}" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3">
                    </td>
                </tr>

                <!-- 建物名 -->
                <tr class="contact-table__row">
                    <th class="contact-table__header">建物名</th>
                    <td class="contact-table__input-building">
                        <input class="contact-table__building" type="text" name="building" value="{{ old('building', $contact['building'] ?? '') }}" placeholder="例:千駄ヶ谷マンション101">
                    </td>
                </tr>

                <!-- お問い合わせの種類 -->
                <tr class="contact-table__row">
                    <th class="contact-table__header">お問い合せの種類<span>※</span></th>
                    <td class="contact-table__input-category">
                        <select name="category" class="contact-table__select">
                            <option value="">選択してください</option>
                            <option value="ご質問" {{ old('category', $contact['category'] ?? '') == 'ご質問' ? 'selected' : '' }}>ご質問</option>
                            <option value="ご意見" {{ old('category', $contact['category'] ?? '') == 'ご意見' ? 'selected' : '' }}>ご意見</option>
                            <option value="その他" {{ old('category', $contact['category'] ?? '') == 'その他' ? 'selected' : '' }}>その他</option>
                        </select>
                    </td>
                </tr>
                <tr class="contact-table__row">
                    <th class="contact-table__header">お問い合せ内容<span>※</span></th>
                    <td class="contact-table__input-content">
                        <textarea name="content" class="contact-table__content" placeholder="お問い合せ内容をご記載ください" rows="10">{{ old('content', $contact['content'] ?? '') }}</textarea>
                    </td>
                </tr>
            </table>
            <div class="contact-form__button">
                <button class="contact-form__button-submit" type="submit">確認画面</button>
                <button class="contact-form__button-reset" type="button" id="reset-button">リセット</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('reset-button').addEventListener('click', function() {
        document.querySelectorAll('#contact-form input, #contact-form textarea, #contact-form select').forEach(function(field) {
            if (field.type === 'radio' || field.type === 'checkbox') {
                field.checked = false;
            } else {
                field.value = '';
            }
        });

        // セレクトボックスをリセットする
        document.querySelectorAll('#contact-form select').forEach(function(field) {
            field.selectedIndex = 0;
        });
    });
</script>


@endsection
