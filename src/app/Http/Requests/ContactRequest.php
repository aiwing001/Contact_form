<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() 
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'last_name' => 'required|string|max:8',
            'first_name' => 'required|string|max:8',
            'gender' => 'required',
            'email' => 'required|email:rfc',
            'tel1' => 'required|regex:/^[a-zA-Z0-9]+$/|max:5',
            'tel2' => 'required|regex:/^[a-zA-Z0-9]+$/|max:5',
            'tel3' => 'required|regex:/^[a-zA-Z0-9]+$/|max:5',
            'address' => 'required|string',
            'category_id' => 'required',
            'detail' => 'required|max:120',
        ];
    }

    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください',
            // ※基本設計に「8文字以内」とあるためmax:8を設定（詳細設計に記載なし）
            'last_name.max' => '姓は8文字以内で入力してください',

            'first_name.required' => '名を入力してください',
            'first_name.max' => '名は8文字姓内で入力してください',

            'gender.required' => '性別を選択してください',

            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',

            'tel1.required' => '電話番号を入力してください',
            'tel1.regex' => '電話番号は半角英数字で入力してください',
            // ※基本設計に合わせて半角数字のみ（メッセージと差異あり）
            'tel1.max' => '電話番号は5桁まで数字で入力してください',

            'tel2.required' => '電話番号を入力してください',
            'tel2.regex' => '電話番号は半角英数字で入力してください',
            'tel2.max' => '電話番号は5桁まで数字で入力してください',

            'tel3.required' => '電話番号を入力してください',
            'tel3.regex' => '電話番号は半角英数字で入力してください',
            'tel3.max' => '電話番号は5桁まで数字で入力してください',

            'address.required' => '住所を入力してください',

            'category_id.required' => 'お問い合わせの種類を選択してください',

            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
