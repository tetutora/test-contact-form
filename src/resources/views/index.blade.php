@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form">
    <div class="contact-form__title">
        <p>Contact</p>
    </div>
    <div class="contact-table">
        <form action="/confirm" method="post">
            @csrf
            <table class="contact-table__inner">
                <tr class="contact-table__row">
                    <th class="contact-table__header">お名前<span>※</span></th>
                    <td class="contact-table__input-name">
                        <input class="contact-table__input-last-name" type="text" name="last_name" placeholder="例：山田">
                        <input class="contact-table__input-first-name" type="text" name="first_name" placeholder="例：太郎">
                    </td>
                </tr>
                <tr class="contact-table__row">
                    <th class="contact-table__header">性別<span>※</span></th>
                    <td class="contact-table__input-gender">
                        <div class="contact-table__gender">
                            <label>
                                <input type="radio" name="gender" value="男性">男性
                            </label>
                            <label>
                                <input type="radio" name="gender" value="女性">女性
                            </label>
                            <label>
                                <input type="radio" name="gender" value="その他">その他
                            </label>
                        </div>
                    </td>
                </tr>
                <tr class="contact-table__row">
                    <th class="contact-table__header">メールアドレス<span>※</span></th>
                    <td class="contact-table__input-email">
                        <input type="email" name="email" placeholder="例：test@example.com" class="contact-table__input-email-content">
                    </td>
                </tr>
                <tr class="contact-table__row">
                    <th class="contact-table__header">電話番号<span>※</span></th>
                    <td class="contact-table__input-tel">
                        <input class="contact-table__tel" type="text" id="tel1" name="tel1" maxlength="5" size="4" placeholder="090"> -
                        <input class="contact-table__tel" type="text" id="tel2" name="tel2" maxlength="5" size="5" placeholder="1234"> -
                        <input class="contact-table__tel" type="text" id="tel3" name="tel3" maxlength="5" size="5" placeholder="5678">
                    </td>
                </tr>
                <tr class="contact-table__row">
                    <th class="contact-table__header">住所<span>※</span></th>
                    <td class="contact-table__input-address">
                        <input class="contact-table__address" type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3">
                    </td>
                </tr>
                <tr class="contact-table__row">
                    <th class="contact-table__header">建物名</th>
                    <td class="contact-table__input-building">
                        <input class="contact-table__building" type="text" name="building" placeholder="例:千駄ヶ谷マンション101">
                    </td>
                </tr>
                <tr class="contact-table__row">
                    <th class="contact-table__header">お問い合せの種類<span>※</span></th>
                    <td class="contact-table__input-category">
                        <select name="category" class="contact-table__select">
                            <option value="">選択してください</option>
                            <option value="ご質問">ご質問</option>
                            <option value="ご意見">ご意見</option>
                            <option value="その他">その他</option>
                        </select>
                    </td>
                </tr>
                <tr class="contact-table__row">
                    <th class="contact-table__header">お問い合せ内容<span>※</span></th>
                    <td class="contact-table__input-content">
                        <textarea name="detail" class="contact-table__content" placeholder="お問い合せ内容をご記載ください" rows="10"></textarea>
                    </td>
                </tr>
            </table>
            <div class="contact-form__button">
                <button class="contact-form__button-submit" type="submit">確認画面</button>
            </div>
        </form>
    </div>
</div>
@endsection
