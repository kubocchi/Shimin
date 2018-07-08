<template>
    <div>
        <h4>
            <span>
                <i class="fas fa-feather"></i>
            </span> 団体情報 登録画面</h4>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="bs-component">
                    <form action="" method="post">
                        <fieldset>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="dantai_no">【団体番号】（必須）</label>
                                <input v-model="groupInformation.number" class="form-control" id="organizer" type="text" v-validate="'required'" name="number" data-vv-as="団体番号">
                                <span class="is-danger">{{ errors.first('number') }}</span>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label">【団体種類】（必須）</label>
                                <div class="col-lg-12 form-group">
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.type" value="0" color="primary-o" checked>一般団体</p-radio>
                                    </div>
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.type" value="1" color="primary-o">個人登録ボランティア</p-radio>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="col-form-label" for="subject">【登録場所】（必須）</label>
                                <multiselect 
                                    v-model="selectedManagement" 
                                    :options="managements" 
                                    @select="onSelectManagement"  
                                    track-by="id" 
                                    label="label" 
                                    placeholder="選んでください" 
                                    selectLabel="" 
                                    deselectLabel="" 
                                    selectedLabel="選ばれた" 
                                    v-validate="'required'" 
                                    name="business" 
                                    data-vv-as="登録場所">
                                </multiselect>
                                <span class="is-danger">{{ errors.first('business') }}</span>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label">【公開状況】（必須）</label>
                                <div class="col-lg-12 form-group">
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.open_situation" value="0" color="primary-o" checked>公開</p-radio>
                                    </div>
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.open_situation" value="1" color="primary-o">非公開</p-radio>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label">【活動状況】（必須）</label>
                                <div class="col-lg-12 form-group">
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.active_status" value="0" color="primary-o" checked>活動中</p-radio>
                                    </div>
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.active_status" value="1" color="primary-o">休止中</p-radio>
                                    </div>
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.active_status" value="2" color="primary-o">抹消</p-radio>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-lg-6">
                                    <label class="col-form-label">休止年月日 / 抹消年月日</label>
                                    <div class="row">
                                        <vue-datepicker-local v-model="groupInformation.pause_date" :local="local" :disabled="groupInformation.active_status == '0' ? true : false" :format="dateFormat"></vue-datepicker-local>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-lg-6">
                                    <label class="col-form-label">【申請年月日】</label>
                                    <div class="row">
                                        <vue-datepicker-local v-model="groupInformation.application_date" :local="local" :format="dateFormat"></vue-datepicker-local>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-lg-6">
                                    <label class="col-form-label">【登録年月日】</label>
                                    <div class="row">
                                        <vue-datepicker-local v-model="groupInformation.registration_date" :local="local" :format="dateFormat"></vue-datepicker-local>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-lg-6">
                                    <label class="col-form-label">【設立年月日】</label>
                                    <div class="row">
                                        <vue-datepicker-local v-model="groupInformation.establishment_date" :local="local" :format="dateFormat"></vue-datepicker-local>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="dantai_name">【団体名】（必須）（漢字または全角ひらがな・カタカナ　例：旭入浴サービス ）</label>
                                <input class="form-control" v-model="groupInformation.name" id="dantai_name" type="text" v-validate="'required'" name="name" data-vv-as="団体名">
                                <span class="is-danger">{{ errors.first('name') }}</span>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="dantai_name_f">【団体名ふりがな】（必須）（ひらがな　例：あさひにゅうよくさーびす ）</label>
                                <input class="form-control" v-model="groupInformation.name_phonetic" id="dantai_name_f" required="" type="text" v-validate="'required'" name="name_phonetic" data-vv-as="団体名ふりがな">
                                <span class="is-danger">{{ errors.first('name_phonetic') }}</span>
                            </div>
                            <hr>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="representative_name">【代表者氏名】（漢字または全角ひらがな・カタカナ　例：旭　太郎）</label>
                                <input class="form-control" v-model="groupInformation.representative_name" id="representative_name" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="representative_name_f">【代表者氏名ふりがな】（ひらがな　例：あさひ　たろう）</label>
                                <input class="form-control" v-model="groupInformation.representative_name_phonetic" id="representative_name_f" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label">【代表者氏名の公開有無】</label>
                                <div class="col-lg-12 form-group">
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_name" value="0" color="primary-o" >公開しない</p-radio>
                                    </div>
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_name" value="1" color="primary-o">公開する</p-radio>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="representative_tel1">【代表者電話番号】 （半角数字　例：03 - 0123 - 4567 ）</label>
                                <input class="form-control" v-model="groupInformation.representative_phone" id="representative_tel1" type="tel">
                            </div>
                             <div class="col-lg-12 form-group">
                                <label class="col-form-label">【代表者電話番号の開示有無】</label>
                                <div class="col-lg-12 form-group">
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_representative_phone" value="0" color="primary-o" checked>開示しない</p-radio>
                                    </div>
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_representative_phone" value="1" color="primary-o">開示する</p-radio>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="representative_tel2">【代表者携帯番号】 （半角数字　例：03 - 0123 - 4567 ）</label>
                                <input class="form-control" v-model="groupInformation.representative_phone_2" id="representative_tel2" type="tel">
                            </div>
                             <div class="col-lg-12 form-group">
                                <label class="col-form-label">【代表者携帯番号の開示有無】</label>
                                <div class="col-lg-12 form-group">
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_representative_phone_2" value="0" color="primary-o" >開示しない</p-radio>
                                    </div>
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_representative_phone_2" value="1" color="primary-o">開示する</p-radio>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="representative_fax">【代表者FAX】 （半角数字　例：03 - 0123 - 4567 ）</label>
                                <input class="form-control"  v-model="groupInformation.representative_fax" id="representative_fax" type="tel">
                            </div>
                             <div class="col-lg-12 form-group">
                                <label class="col-form-label">【代表者FAXの開示有無】</label>
                                <div class="col-lg-12 form-group">
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_representative_fax" value="0" color="primary-o" checked>開示しない</p-radio>
                                    </div>
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_representative_fax" value="1" color="primary-o">開示する</p-radio>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="contact_name">【連絡先・事務所・事務局名】（漢字または全角ひらがな・カタカナ　例：旭　太郎、または○○団体事務局 ）</label>
                                <input class="form-control" v-model="groupInformation.contact_name" id="contact_name" type="text" required="">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="contact_name_f">【連絡先・事務所・事務局ふりがな】（ひらがな　例：あさひ　たろう、または○○だんたいじむきょく ）</label>
                                <input class="form-control" v-model="groupInformation.contact_name_phonetic" id="contact_name_f" type="text">
                            </div>
                             <div class="col-lg-12 form-group">
                                <label class="col-form-label">【連絡先・事務所・事務局の公開有無】</label>
                                <div class="col-lg-12 form-group">
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_contact_name" value="0" color="primary-o" checked>公開しない  </p-radio>
                                    </div>
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_contact_name" value="1" color="primary-o">公開する</p-radio>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="postal_code">【連絡先・事務所・事務局郵便番号】 （半角数字　例：100-8440 ）</label>
                                <input class="form-control" v-model="groupInformation.postal_code" id="postal_code" type="text">
                            </div>
                            <div class="col-lg-12 form-group"> 【住所（所在地）】（必須）
                                <br>
                                <div class="form-group mt-3">
                                    <input class="form-control" v-model="groupInformation.contact_address" id="m_address" type="text" v-validate="'required'" name="contact_address" data-vv-as="住所">
                                    <span class="is-danger">{{ errors.first('contact_address') }}</span>
                                </div>
                                <div class="form-inline">
                                    <div class="form-group form-inline text-right">
                                        <label class="col-form-label" for="address_name"></label>宛名
                                        <input class="form-control" v-model="groupInformation.contact_address_name" id="address_name" type="text">
                                    </div> &nbsp;
                                    <div class="form-group form-inline text-right">
                                        <label class="col-form-label" for="address_title"></label>敬称
                                        <input class="form-control" v-model="groupInformation.contact_address_title" id="address_title" type="text">
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-12 form-group">
                                <label class="col-form-label">【所在地の公開有無】</label>
                                <div class="col-lg-12 form-group">
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_contact_address" value="0" color="primary-o" checked>開示しない</p-radio>
                                    </div>
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_contact_address" value="1" color="primary-o">開示する</p-radio>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="contact_tel1">【連絡先電話番号】 （半角数字　例：03 - 0123 - 4567 ）</label>
                                <input class="form-control" v-model="groupInformation.contact_phone" id="contact_tel1" type="tel">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label">【連絡先電話番号の公開有無】</label>
                                <div class="col-lg-12 form-group">
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_contact_phone" value="0" color="primary-o" checked>公開しない</p-radio>
                                    </div>
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_contact_phone" value="1" color="primary-o">公開する</p-radio>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="contact_tel2">【連絡先携帯番号】 （半角数字　例：03 - 0123 - 4567 ）</label>
                                <input class="form-control" v-model="groupInformation.contact_phone_2" id="contact_tel2" type="tel">
                            </div>
                             <div class="col-lg-12 form-group">
                                <label class="col-form-label">【連絡先携帯番号の公開有無】</label>
                                <div class="col-lg-12 form-group">
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_contact_phone_2" value="0" color="primary-o" checked>公開しない</p-radio>
                                    </div>
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_contact_phone_2" value="1" color="primary-o">公開する</p-radio>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="contact_fax">【連絡先FAX】 （半角数字　例：03 - 0123 - 4567 ）</label>
                                <input class="form-control" v-model="groupInformation.contact_fax" id="contact_fax" type="tel">
                            </div>
                             <div class="col-lg-12 form-group">
                                <label class="col-form-label">【連絡先FAXの公開有無】</label>
                                <div class="col-lg-12 form-group">
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_contact_fax" value="0" color="primary-o" checked>公開しない</p-radio>
                                    </div>
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_contact_fax" value="1" color="primary-o">公開する</p-radio>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="contact_mail">【e-mail】 （半角数字　例：taro@genki365.com ）</label>
                                <input class="form-control"  v-model="groupInformation.contact_mail" id="contact_mail" type="email">
                            </div>
                             <div class="col-lg-12 form-group">
                                <label class="col-form-label">【e-mailの公開有無】</label>
                                <div class="col-lg-12 form-group">
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_contact_mail" value="0" color="primary-o" checked>公開しない</p-radio>
                                    </div>
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_contact_mail" value="1" color="primary-o">公開する</p-radio>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="contact_url">【URL】 （半角数字　例：http://www.genki365.com/ ）</label>
                                <input class="form-control"  v-model="groupInformation.contact_url" id="contact_url" type="url">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label">【URLの公開有無】</label>
                                <div class="col-lg-12 form-group">
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_contact_url" value="0" color="primary-o" checked>公開しない</p-radio>
                                    </div>
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.disclosure_contact_url" value="1" color="primary-o">公開する</p-radio>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label">【活動分類】（必須）</label>
                                <div class="col-lg-12 form-group">
                                    <div v-for="activityCategory in activityCategories" v-bind:key="activityCategory.id" class="form-group row" >
                                        <p-check class="p-default p-curve p-thick p-smooth" 
                                            v-model="groupInformation.activity_category" 
                                            :id="'category_' + activityCategory.id" 
                                            :value="activityCategory.id" 
                                            color="primary-o" 
                                            v-validate="'required'" 
                                            name="activity_category" 
                                            data-vv-as="活動分類">
                                            {{activityCategory.name}}
                                        </p-check>
                                    </div>
                                    <span class="is-danger">{{ errors.first('activity_category') }}</span>
                                    <div class="form-group">
                                        <input class="form-control"  v-model="groupInformation.active_category_supplement" id="active_category23_supplement" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="menber_m">【会員数（男性）】 （半角数字）</label>
                                <input class="form-control" v-model="groupInformation.membership_male" id="menber_m" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="menber_f">【会員数（女性）】 （半角数字）</label>
                                <input class="form-control" v-model="groupInformation.membership_female" id="menber_f" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="menber_sum">【会員数（合計）】 （半角数字）</label>
                                <input class="form-control" v-model="groupInformation.all_member" id="menber_sum" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                【活動回数】
                                <div class="form-inline">
                                    <div class="form-group form-inline text-right">
                                        <label class="col-form-label" for="activity_frequency"></label> 
                                        <input class="form-control" v-model="groupInformation.activity_frequency" id="activity_frequency" type="text">&nbsp; 回 / &nbsp;
                                    </div>
                                    <div class="form-group form-inline text-right">
                                        <multiselect 
                                            v-model="selectedActivityDay" 
                                            :options="activityDays" 
                                            @select="onSelectActivityDay" 
                                            track-by="id" 
                                            label="label"
                                            placeholder="活動回数" 
                                            selectLabel="" 
                                            deselectLabel="" 
                                            selectedLabel="選ばれた" >
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label">【会費】</label>
                                <div class="col-lg-12 form-group">
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.dues" value="0" color="primary-o" checked>無</p-radio>
                                    </div>
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="groupInformation.dues" value="1" color="primary-o"> 有（例：年会費3,000円、月額200円）</p-radio>
                                    </div>
                                </div>
                                <div class="form-inline">
                                    <div class="form-group form-inline text-right">
                                        <label class="col-form-label" for="dues_price"></label>
                                        <input class="form-control"  v-model="groupInformation.dues_price" :disabled="groupInformation.dues == '0' ? true : false" id="dues_price" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label for="contents">【活動内容・事業内容】（全角1000字以内）</label>
                                <textarea class="form-control" v-model="groupInformation.content" id="contents" rows="3"></textarea>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="rocker">【ロッカー】</label>
                                <input class="form-control" v-model="groupInformation.rocker" id="rocker" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="mail_box">【メールBOX】</label>
                                <input class="form-control" v-model="groupInformation.mail_box" id="mail_box" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="method">【方法】</label>
                                <input class="form-control" v-model="groupInformation.method" id="method" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label for="dantai_supplement">【備考】（全角1000字以内）※非公開。ここに入力された内容はコーディネイター以外には公開されません。</label>
                                <textarea class="form-control" v-model="groupInformation.supplement" id="dantai_supplement" rows="3"></textarea>
                            </div>

                             <router-link :to="{ name: 'groupInformationList' }">
                                <button class="btn btn-outline-primary">戻る</button>
                            </router-link> 


                            <button type="button" class="btn btn-primary" @click.prevent="confirm">
                                確認に進む
                            </button>   

                            <!-- Confirmation Modal -->
                            <div class="modal" id="confirmationModal">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                    <h4 class="modal-subject">
                                        <span>
                                            <i class="fas fa-dove"></i>
                                        </span>団体情報 登録確認画面
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="row mt-4">
                                            <div class="col-lg-12">
                                                <div class="bs-component">
                                                    <div style="overflow:hidden;">
                                                        <form action="" method="post">
                                                            <p>登録内容を確認し問題がなければ登録ボタンを押してください。</p>
                                                            <div>
                                                                <div>
                                                                    <label>【団体番号】</label>
                                                                    <p>{{groupInformation.number}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【団体種類】</label>
                                                                     <p>{{groupInformation.type === '0'? '一般団体' : '個人登録ボランティア'}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【登録場所】</label>
                                                                     <p>{{groupInformation.number}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【公開状況】</label>
                                                                    <p>公開</p>
                                                                </div>
                                                                <div>
                                                                    <label>【活動状況】</label>
                                                                    <p>休止中</p>
                                                                    <p>{{groupInformation.pause_date}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【申請年月日】</label>
                                                                    <p>{{groupInformation.application_date}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【登録年月日】</label>
                                                                    <p>{{groupInformation.registration_date}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【設立年月日】</label>
                                                                    <p>{{groupInformation.establishment_date}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【団体名】</label>
                                                                     <p>{{groupInformation.name}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【団体名ふりがな】</label>
                                                                     <p>{{groupInformation.name_phonetic}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【代表者氏名】</label>
                                                                     <p>{{groupInformation.representative_name}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【代表者氏名ふりがな】</label>
                                                                     <p>{{groupInformation.representative_name_phonetic}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【代表者氏名の公開有無】</label>
                                                                     <p>{{groupInformation.representative_phone}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【代表者電話番号】</label>
                                                                     <p>{{groupInformation.disclosure_representative_phone}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【代表者電話番号】</label>
                                                                    <p>開示しない</p>
                                                                </div>
                                                                <div>
                                                                    <label>【代表者携帯番号】</label>
                                                                     <p>{{groupInformation.number}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【代表者携帯番号の開示有無】</label>
                                                                    <p>開示しない</p>
                                                                </div>
                                                                <div>
                                                                    <label>【代表者FAX】</label>
                                                                     <p>{{groupInformation.representative_fax}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【代表者FAXの開示有無】</label>
                                                                    <p>{{groupInformation.disclosure_representative_fax === '0'? '公開しない' : '公開する'}}'}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【連絡先・事務所・事務局】</label>
                                                                     <p>{{groupInformation.number}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【連絡先・事務所・事務局ふりがな】</label>
                                                                     <p>{{groupInformation.number}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【連絡先・事務所・事務局の公開有無】</label>
                                                                    <p>{{groupInformation.disclosure_representative_fax === '0'? '公開しない' : '公開する'}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【連絡先・事務所・事務局郵便番号】</label>
                                                                    <p>100-8440</p>
                                                                </div>
                                                                <div>
                                                                    <label>【住所（所在地）】</label>
                                                                    <p>宮崎県宮崎市</p>
                                                                    <p>施策太郎</p>
                                                                    <p>様</p>
                                                                </div>
                                                                <div>
                                                                    <label>【所在地の公開有無】</label>
                                                                    <p>{{groupInformation.disclosure_representative_fax === '0'? '公開しない' : '公開する'}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【連絡先電話番号（１）】</label>
                                                                     <p>{{groupInformation.number}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【連絡先電話番号（１）の公開有無】</label>
                                                                    <p>市民活動センターへ問い合わせ</p>
                                                                </div>
                                                                <div>
                                                                    <label>【連絡先電話番号（２）】</label>
                                                                    <p>03 - 0123 - 4567</p>
                                                                </div>
                                                                <div>
                                                                    <label>【連絡先電話番号（２）の公開有無】</label>
                                                                    <p>{{groupInformation.disclosure_representative_fax === '0'? '公開しない' : '公開する'}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【連絡先FAX】</label>
                                                                    <p>03 - 0123 - 5555</p>
                                                                </div>
                                                                <div>
                                                                    <label>【連絡先FAXの公開有無】</label>
                                                                    <p>{{groupInformation.disclosure_representative_fax === '0'? '公開しない' : '公開する'}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【e-mail】</label>
                                                                    <p>{{groupInformation.contact_mail}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【e-mailの公開有無】</label>
                                                                    <p>{{groupInformation.disclosure_contact_mail === '0'? '公開しない' : '公開する'}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【URL】</label>
                                                                    <p>{{groupInformation.contact_url}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【活動分類】</label>
                                                                    <p>高齢者福祉</p>
                                                                </div>
                                                                <div>
                                                                    <label>【会員数（男性）】</label>
                                                                     <p>{{groupInformation.number}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【会員数（女性）】</label>
                                                                     <p>{{groupInformation.number}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【会員数（合計）】</label>
                                                                     <p>{{groupInformation.number}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【活動回数】</label>
                                                                    <p>1回　/　月</p>
                                                                </div>
                                                                <div>
                                                                    <label>【会費】</label>
                                                                    <p>有</p>
                                                                    <p>年会費3,000円</p>
                                                                </div>
                                                                <div>
                                                                    <label>【活動内容・事業内容】</label>
                                                                     <p>{{groupInformation.number}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【ロッカー】</label>
                                                                     <p>{{groupInformation.number}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【メールBOX】</label>
                                                                     <p>{{groupInformation.number}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【方法】</label>
                                                                     <p>{{groupInformation.number}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【備考】</label>
                                                                     <p>{{groupInformation.number}}</p>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">戻る</button>
                                        <button type="button" class="btn btn-outline-primary" @click.prevent="submitClicked" >登録</button>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!--Progress Modal -->
                            <div class="modal" id="progressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCentersubject" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" 
                                                aria-valuemin="0" aria-valuemax="100" v-bind:style="{ width: computedWidth }"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import VueDatepickerLocal from 'vue-datepicker-local'
    import Multiselect from "vue-multiselect"

    export default {
        components: { Multiselect, VueDatepickerLocal },
        data() {
            return {
                groupInformation: {
                    id: "",
                    number: "",
                    type: "0",
                    regist_management: null,
                    open_situation: "0",
                    active_status: "0",
                    pause_date: new Date(),
                    application_date: new Date(),
                    registration_date: new Date(),
                    establishment_date: new Date(),
                    name: "",
                    name_phonetic: "",
                    representative_name: "",
                    representative_name_phonetic: "",
                    disclosure_name: "0",
                    representative_phone: "",
                    disclosure_representative_phone: "0",
                    representative_phone_2: "",
                    disclosure_representative_phone_2: "0",
                    representative_fax: "",
                    disclosure_representative_fax: "0",
                    contact_name: "",
                    contact_name_phonetic: "",
                    disclosure_contact_name: "0",
                    postal_code: "",
                    contact_address: "",
                    contact_address_name: "",
                    contact_address_title: "",
                    disclosure_contact_address: "0",
                    contact_phone: "",
                    disclosure_contact_phone: "0",
                    contact_phone_2: "",
                    disclosure_contact_phone_2: "0",
                    contact_fax: "",
                    disclosure_contact_fax: "0",
                    contact_mail: "",
                    disclosure_contact_mail: "0",
                    contact_url: "",
                    disclosure_contact_url: "0",
                    activity_category: [],
                    active_category_supplement: "",
                    membership_male: "",
                    membership_female: "",
                    all_member: "",

                    dues: "0",
                    dues_price: "",
                    content: "",
                    rocker: "",
                    mail_box: "",
                    method: "",
                    supplement: "",
                    deactivate: false,
                   updated_by: this.$store.state.user != null? this.$store.state.user.id : 0,
                    created_by: this.$store.state.user != null? this.$store.state.user.id : 0
                },
                id: "",
                pagination: {},
                edit: false,
                dateFormat: 'YYYY-MM-DD',
                switchColorDeactivate: '#DC3545',
                time: new Date(),
                range: [new Date(), new Date()],
                emptyTime: '',
                emptyRange: [],
                local: {
                    dow: 0, // Sunday is the first day of the week
                    hourTip: 'Select Hour', // tip of select hour
                    minuteTip: 'Select Minute', // tip of select minute
                    secondTip: 'Select Second', // tip of select second
                    yearSuffix: '', // suffix of head year
                    monthsHead: '一月_二月_三月_四月_五月_六月_七月_八月_九月_十月_十一月_十二月'.split('_'), // months of head
                    months: '一_二_三_四_五_六_七_八_九_十_十一_十二'.split('_'), // months of panel
                    weeks: '日_月_火_水_木_金_土'.split('_'), // weeks,
                    cancelTip: 'cancel',
                    submitTip: 'confirm'
                },
                // You can store all your files here
                attachments: [],
                attachment_labels: [], // List of old uploaded files coming from the server
                // Each file will need to be sent as FormData element
                uploadedData: new FormData(),
                percentCompleted: 0,
                tempRemovedFileIds: [],
                currentAddedFileIs: [],
                width: '0%',
                managements: [
                    { 'id': 1, 'label': 'センター' },
                    { 'id': 2, 'label': '社協' },
                    { 'id': 3, 'label': '佐土原' },
                    { 'id': 4, 'label': '高岡' },
                    { 'id': 5, 'label': '田野' },
                    { 'id': 6, 'label': '清武' },
                ],
                selectedManagement: null,
                activityCategories: [
                    { id: "100", name: "保健・医療" },
                    { id: "200", name: "高齢者福祉" },
                    { id: "300", name: "障害者福祉" },
                    { id: "400", name: "児童福祉" },
                    { id: "500", name: "社会教育" },
                    { id: "600", name: "まちづくり" },
                    { id: "700", name: "観光" },
                    { id: "800", name: "農山漁村" },
                    { id: "900", name: "文化芸術" },
                    { id: "1000", name: "環境保全" },
                    { id: "1100", name: "災害救援" },
                    { id: "1200", name: "地域安全" },
                    { id: "1300", name: "人権・平和" },
                    { id: "1400", name: "国際協力" },
                    { id: "1500", name: "男女共同" },
                    { id: "1600", name: "子供育成" },
                    { id: "1700", name: "情報社会" },
                    { id: "1800", name: "科学技術" },
                    { id: "1900", name: "経済活動" },
                    { id: "2000", name: "職業・雇用" },
                    { id: "2100", name: "消費者保護" },
                    { id: "2200", name: "NPO支援" },
                    { id: "2300", name: "その他区分" },
                ],
                selectedActivityCategory: null,
                item: {
                    category: []
                },
                activityDays: [
                    { 'id': 1, 'label': '年' },
                    { 'id': 2, 'label': '月' },
                    { 'id': 3, 'label': '週' },
                    { 'id': 4, 'label': '-' },
                ],
                selectedActivityDay:  { 'id': 1, 'label': '年' },
            };
        },
        computed: {
            computedWidth: function () {
                return this.width;
            }
        },

        created() {
            console.log(this.$route.params)
            if (this.$route.params.model)
                this.fillFormWithRecievedModel(this.$route.params.model)

            if (this.$route.params.requestType === 'edit')
                this.edit = true
        },

        methods: {
            // Add new, sends model to API
            addGroupInformation() {
                this.groupInformation.activity_category = this.groupInformation.activity_category.join(',')

                let self = this
                console.log(this.groupInformation)

                if (this.edit === false) {
                    // Add
                    NProgress.start()
                    fetch("/api/group-information", {
                        method: "post",
                        body: JSON.stringify(this.groupInformation),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            NProgress.done()
                            self.$swal({
                                title: "登録完了!",
                                text: "登録が完了しました!",
                                type: "success",
                                confirmButtonText: 'OK'
                            })
                                .then(function () {
                                    self.$router.push({
                                        name: 'groupInformationList'
                                    })
                                });
                        })
                        .catch(err => console.log(err))
                } else {

                    // Update
                    NProgress.start()
                    fetch("/api/group-information", {
                        method: "put",
                        body: JSON.stringify(this.groupInformation),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            NProgress.done()
                            self.$swal({
                                title: "成功!",
                                text: "活動センターが追加されました!",
                                type: "success",
                                confirmButtonText: 'OK'
                            })
                                .then(function () {
                                    self.$router.push({
                                        name: 'groupInformationList'
                                    })
                                });
                        })
                        .catch(err => console.log(err))
                }
            },

            // Edit new, sends model to API
            fillFormWithRecievedModel(groupInformation) {
                console.log(groupInformation)
                this.pullAttachments(groupInformation)

                this.groupInformation.id= groupInformation.id,
                this.groupInformation.number= groupInformation.number,
                this.groupInformation.type= groupInformation.type,
                this.groupInformation.regist_management= groupInformation.regist_management,
                this.groupInformation.open_situation= groupInformation.open_situation,
                this.groupInformation.active_status= groupInformation.active_status,
                this.groupInformation.pause_date= groupInformation.pause_date,
                this.groupInformation.application_date= groupInformation.application_date,
                this.groupInformation.registration_date= groupInformation.registration_date,
                this.groupInformation.establishment_date= groupInformation.establishment_date,
                this.groupInformation.name= groupInformation.name,
                this.groupInformation.name_phonetic= groupInformation.name_phonetic,
                this.groupInformation.representative_name= groupInformation.representative_name,
                this.groupInformation.representative_name_phonetic= groupInformation.representative_name_phonetic,
                this.groupInformation.disclosure_name= groupInformation.disclosure_name,
                this.groupInformation.representative_phone= groupInformation.representative_phone,
                this.groupInformation.disclosure_representative_phone= groupInformation.disclosure_representative_phone,
                this.groupInformation.representative_phone_2= groupInformation.representative_phone_2,
                this.groupInformation.disclosure_representative_phone_2= groupInformation.disclosure_representative_phone_2,
                this.groupInformation.representative_fax= groupInformation.representative_fax,
                this.groupInformation.disclosure_representative_fax= groupInformation.disclosure_representative_fax,
                this.groupInformation.contact_name= groupInformation.contact_name,
                this.groupInformation.contact_name_phonetic= groupInformation.contact_name_phonetic,
                this.groupInformation.disclosure_contact_name= groupInformation.disclosure_contact_name,
                this.groupInformation.postal_code= groupInformation.postal_code,
                this.groupInformation.contact_address= groupInformation.contact_address,
                this.groupInformation.contact_address_name= groupInformation.contact_address_name,
                this.groupInformation.contact_address_title= groupInformation.contact_address_title,
                this.groupInformation.disclosure_contact_address= groupInformation.disclosure_contact_address,
                this.groupInformation.contact_phone= groupInformation.contact_phone,
                this.groupInformation.disclosure_contact_phone= groupInformation.disclosure_contact_phone,
                this.groupInformation.contact_phone_2= groupInformation.contact_phone_2,
                this.groupInformation.disclosure_contact_phone_2= groupInformation.disclosure_contact_phone_2,
                this.groupInformation.contact_fax= groupInformation.contact_fax,
                this.groupInformation.disclosure_contact_fax= groupInformation.disclosure_contact_fax,
                this.groupInformation.contact_mail= groupInformation.contact_mail,
                this.groupInformation.disclosure_contact_mail= groupInformation.disclosure_contact_mail,
                this.groupInformation.contact_url= groupInformation.contact_url,
                this.groupInformation.disclosure_contact_url= groupInformation.disclosure_contact_url,
                this.groupInformation.activity_category= groupInformation.activity_category,
                this.groupInformation.active_category_supplement= groupInformation.active_category_supplement,
                this.groupInformation.membership_male= groupInformation.membership_male,
                this.groupInformation.membership_female= groupInformation.membership_female,
                this.groupInformation.all_member= groupInformation.all_member,
                this.groupInformation.dues= groupInformation.dues,
                this.groupInformation.activity_frequency= groupInformation.activity_frequency,
                this.groupInformation.dues= groupInformation.dues,
                this.groupInformation.dues_price= groupInformation.dues_price,
                this.groupInformation.content= groupInformation.content,
                this.groupInformation.rocker= groupInformation.rocker,
                this.groupInformation.mail_box= groupInformation.mail_box,
                this.groupInformation.method= groupInformation.method,
                this.groupInformation.supplement= groupInformation.supplement,
                this.groupInformation.deactivate = !!groupInformation.deactivate == 1 ? true : false
                this.groupInformation.created_by = groupInformation.created_by
                this.groupInformation.updated_by = groupInformation.updated_by

                // For Files
                if (groupInformation.file)
                    this.currentAddedFileIs = groupInformation.file.split(',')
            },

            // Analyzing attachmet file size
            getAttachmentSize() {
                this.upload_size = 0; // Reset to beginningƒ
                this.attachments.map((item) => { this.upload_size += parseInt(item.size); });
                this.upload_size = Number((this.upload_size).toFixed(1));
                this.$forceUpdate();
            },

            // Preparing files 
            prepareFields() {
                for (var i = this.attachments.length - 1; i >= 0; i--) {
                    console.log(this.attachments[i].category_id);
                    this.uploadedData.append("attachments[][0]", this.attachments[i]);
                    this.uploadedData.append("attachments[][1]", this.attachments[i].category_id);
                }

                for (var i = this.attachment_labels.length - 1; i >= 0; i--) {
                    this.uploadedData.append("attachment_labels[]", JSON.stringify(this.attachment_labels[i]));
                }
            },

            // Removing attachment on button click
            removeAttachment(attachment) {
                console.log(attachment)
                if (attachment.id)
                    this.tempRemovedFileIds.push(attachment.id)

                this.attachments.splice(this.attachments.indexOf(attachment), 1);
                this.getAttachmentSize();
            },

            // This function will be called every time you add a file
            uploadFieldChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;

                for (var i = files.length - 1; i >= 0; i--) {
                    this.attachments.push(files[i]);
                }

                // Reset the form to avoid copying these files multiple times into this.attachments
                document.getElementById("attachments").value = []
                console.log(attachments);
            },

            // Adding attachment, Sends request to Attachment API
            addAttachment() {
                this.prepareFields()

                var config = {
                    headers: { 'Content-Type': 'multipart/form-data' },
                    onUploadProgress: function (progressEvent) {
                        this.percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total)
                        console.log(this.percentCompleted)
                        this.width = this.percentCompleted + '%'
                        this.$forceUpdate()
                    }.bind(this)
                };

                //Make HTTP request to store announcement
                $("#progressModal").modal({ backdrop: 'static' }, 'show');
                axios.post('/api/attachments/store', this.uploadedData, config)
                    .then(function (response) {
                        console.log(response);
                        if (response.data.success) {
                            console.log('Successfull upload')
                            this.currentAddedFileIs.push(response.data.data)
                            this.resetData()
                            this.addGroupInformation()
                            NProgress.done()
                        } else {
                            console.log('Unsuccessful Upload')
                        }
                    }
                        .bind(this)) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                    .catch(function (error) {
                        console.log('Attachment catch', error)
                    });
                console.log(attachments)
            },

            // We want to clear the FormData object on every upload so we can re-calculate new files again.
            // Keep in mind that we can delete files as well so in the future we will need to keep track of that as well
            resetData() {
                this.uploadedData = new FormData(); // Reset it completely
                this.attachments = [];
            },

            // Removing attachment form database and server, sends file id to attachment remove API
            removeServerAttachment(attachment_id) {
                let data = {
                    params:
                    {
                        attachment_id: attachment_id
                    }
                };

                // Make HTTP request to store announcement
                axios.delete('/api/attachments/', data)
                    .then(function (response) {
                        console.log(response)
                        if (response.data.success) {
                            this.getAttachmentSize()
                        } else {
                            console.log(response.data.errors)
                        }

                    }.bind(this)) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            // Pull required attachmets
            pullAttachments(groupInformation) {
                // Make HTTP request to store announcement
                axios.get(`/api/asset/attachments/${groupInformation.file}`).then(function (response) {
                    console.log(response);
                    if (response.data.success) {
                        this.attachments = response.data.data;
                        console.log('Attachments: ', this.attachments)
                        this.getAttachmentSize()
                    } else {
                        console.log(response.data.errors)
                    }

                }.bind(this)) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                    .catch(function (error) {
                        console.log(error);
                    });

            },

            // Final submisison clicked for form data
            submitClicked() {
                $("#confirmationModal").modal('hide')
                if (this.tempRemovedFileIds.length) {
                    this.tempRemovedFileIds.forEach(id => {
                        this.removeServerAttachment(id)
                        this.currentAddedFileIs.filter(item => item !== id)
                    })
                }

                if (this.attachments.length)
                    this.addAttachment()
                else
                    this.addGroupInformation()
            },

            // Checking for validation and reconfirm opening modal
            confirm() {
                this.$validator.validate().then(result => {
                    if (!result) {
                        console.log('true')
                    }
                    else {
                        this.groupInformation.pause_date = this.groupInformation.pause_date.toISOString().slice(0, 10)
                        this.groupInformation.application_date = this.groupInformation.application_date.toISOString().slice(0, 10)
                        this.groupInformation.registration_date = this.groupInformation.registration_date.toISOString().slice(0, 10)
                        this.groupInformation.establishment_date = this.groupInformation.establishment_date.toISOString().slice(0, 10)
                        $("#confirmationModal").modal('show')
                    }
                });
            },
            onSelectManagement(selectedOption, id) {
                if(selectedOption){
                    this.groupInformation.regist_management = selectedOption.id
                    console.log(selectedOption.id)
                }
            },
            onSelectActivityCategory(selectedOption, id) {
                if(selectedOption){
                    this.groupInformation.activity_category = selectedOption.id
                    console.log(selectedOption.id)
                }
            },
            onSelectActivityDay(selectedOption, id) {
                if(selectedOption){
                    this.groupInformation.activity_day = selectedOption.id
                    console.log(selectedOption.id)
                }
            }
        }
    };
</script>