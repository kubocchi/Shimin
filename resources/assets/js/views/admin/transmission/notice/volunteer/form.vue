<template>
    <div>
        <h4>
            <span>
                <i class="fas fa-dove"></i>
            </span>ボランティア 情報登録画面</h4>
        <hr>

        <div class="row">
            <div class="col-lg-12">
                <div class="bs-component">
                    <form @submit.prevent="confirm">
                        <fieldset>
                            <div class="form-group col-lg-12">
                                <label class="col-form-label" for="subject">【件名】（必須）</label>
                                <input v-model="volunteer.subject" class="form-control" id="subject" type="text" v-validate="'required'" name="subject" data-vv-as="件名">
                                <span class="is-danger">{{ errors.first('subject') }}</span>
                            </div>
                            <div class="col-lg-12">
                                <label>【フォーマット】</label>
                                <p>ボランティア</p>
                            </div>
                            <div class="form-group col-sm-12 col-lg-12">
                                <label for="active_category">【活動カテゴリ】（必須）</label>
                                <multiselect v-model="selectedActivityCategory" :options="categories" @select="onActivityCategorySelect" placeholder="選んでください"
                                    selectLabel="クリックして選択する" deselectLabel="クリックして選択を解除する" selectedLabel="選ばれた" track-by="id"
                                    label="name" v-validate="'required'" name="activity_category" data-vv-as="活動カテゴリ">
                                </multiselect>
                                <span class="is-danger">{{ errors.first('activity_category') }}</span>
                            </div>

                            <div class="col-lg-12 form-group">
                                <label class="col-form-label">【子供の参加】</label>
                                <div class="form-group row">
                                    <toggle-button v-model="volunteer.children" :width="60" :value="true" :color="switchColorOther" :sync="true" :labels="{ checked: 'はい', unchecked: 'いいえ' }"
                                    />
                                </div>
                            </div>
                            <!-- <div class="form-group col-sm-12 col-lg-12">
                                <label class="col-form-label">【掲載開始日】（必須）</label>
                                <div class="row">
                                    <vue-datepicker-local v-model="range" :local="local" :format="dateFormat"></vue-datepicker-local>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="form-group col-sm-12 col-lg-6">
                                    <label class="col-form-label">【掲載期間】（必須）</label>
                                    <div class="row">
                                        <vue-datepicker-local v-model="range" :local="local" :format="dateFormat"></vue-datepicker-local>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-lg-6">
                                    <label class="col-form-label">【開催期間】（必須）</label>
                                    <div class="row">
                                        <vue-datepicker-local v-model="eventDateRange" :local="local" :format="dateFormat"></vue-datepicker-local>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="sponsor">【募集団体】</label>
                                <input v-model="volunteer.sponsor" class="form-control" id="sponsor" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label for="inputFile">【添付ファイル】</label>
                                <div class="file-upload">
                                    <div class="form-group">
                                        <label class="btn btn-outline-primary btn-sm" for="attachments" :hidden="attachments.length > 0 ? true : false">
                                            <input type="file" id="attachments" style="display: none" @change="uploadFieldChange" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.zip,application/zip,application/x-zip,application/x-zip-compressed"> 参照
                                        </label>
                                        <div class="form-group files">
                                            <div class="attachment-holder animated fadeIn" v-cloak v-bind:key="attachment.id" v-for="attachment in attachments">
                                                <div class="form-group">
                                                    <button class="btn btn-outline-danger btn-sm" @click.prevent="removeAttachment(attachment)">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                    <span class="label label-primary">{{ attachment.name + ' (' + Number((attachment.size / 1024 / 1024).toFixed(1))
                                                        + 'MB)'}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="activity_date">【活動日時】例）常時募集、毎週○曜、○月○日～○月○日、など。</label>
                                <input v-model="volunteer.activity_date" class="form-control" id="activity_date" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="deadline">【締切日】例）先着順、締切日、など。</label>
                                <input v-model="volunteer.deadline" class="form-control" id="deadline" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="activity_location">【活動場所】例）○○公園、○○会館○階、主に○川の川原、など。</label>
                                <input v-model="volunteer.activity_location" class="form-control" id="activity_location" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="number_of_people">【募集人数】</label>
                                <input v-model="volunteer.number_of_people" class="form-control" id="number_of_people" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="orientation">【オリエンテーションの有無】</label>
                                <input v-model="volunteer.orientation" class="form-control" id="orientation" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="cost">【費用負担】例）集合場所から活動場所への交通費、お弁当、行事保険代○円、など。</label>
                                <input v-model="volunteer.cost" class="form-control" id="cost" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="subscription">【申込方法】例）事前に電話、当日来場可、等の申込方法。</label>
                                <input v-model="volunteer.subscription" class="form-control" id="subscription" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label for="content">【内容詳細】活動内容、上記の記入内容についての詳細・補足や、ボランティア保険について、持ち物、当日のスケジュール、雨天時の扱い、車での来場に関する扱い等をお書きください。</label>
                                <wysiwyg v-model="volunteer.content" type="text" />
                            </div>
                            <div class="col-lg-12 form-group">
                                <label for="contents">【関連URL】</label>
                                <input v-model="volunteer.linkname" class="form-control" id="linkname" type="text" v-validate="'url:{require_protocol?}'"
                                    name="url" data-vv-as="関連URL">
                                <span class="is-danger">{{ errors.first('url') }}</span>
                            </div>
                            <div class=" col-lg-12 form-group">
                                <label for="contact">【問い合わせ先】電話番号、ファックス番号、メールアドレス、など。</label>
                                <!-- <textarea v-model="volunteer.contact" class="form-control" id="contact" required="" rows="3"></textarea> -->
                                <wysiwyg v-model="volunteer.contact" type="text" />
                            </div>

                            <div class="col-lg-12 form-group">
                                <label class="col-form-label">【サイトに公開する】</label>
                                <div class="form-group row">
                                    <toggle-button v-model="volunteer.deactivate" :width="60" :value="true" :color="switchColorDeactivate" :sync="true" :labels="{ checked: '非公開', unchecked: '公開' }"
                                    />
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <router-link :to="{ name: 'noticeList' }">
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
                                    <h4 class="modal-title">
                                        <span>
                                            <i class="fas fa-dove"></i>
                                        </span>ボランティア情報 登録確認画面
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
                                                                <label>【件名】</label>
                                                                <p>{{volunteer.subject}}</p>
                                                            </div>
                                                            <div>
                                                                <label>【フォーマット】</label>
                                                                <p>ボランティア</p>
                                                            </div>
                                                            <div>
                                                                <label>【活動カテゴリ】</label>
                                                                <p>{{selectedActivityCategory? selectedActivityCategory.name
                                                                    : ''}}</p>
                                                            </div>
                                                            <div>
                                                                <label>【子供の参加】</label>
                                                                <p>{{volunteer.children? 'はい' : 'いいえ'}}</p>
                                                            </div>
                                                            <div>
                                                                <label>【掲載開始日】</label>
                                                                <p>{{volunteer.start_date}}</p>
                                                            </div>
                                                            <div>
                                                                <label>【掲載終了日】</label>
                                                                <p>{{volunteer.end_date}}</p>
                                                            </div>
                                                            <div>
                                                                <label>【開催開始日】</label>
                                                                <p>{{volunteer.event_start_date}}</p>
                                                            </div>
                                                            <div>
                                                                <label>【開催終了日】</label>
                                                                <p>{{volunteer.event_end_date}}</p>
                                                            </div>
                                                            <div>
                                                                <label>【募集団体】</label>
                                                                <p>{{volunteer.sponsor}}</p>
                                                            </div>
                                                            <div>
                                                                <label>【イメージ画像】</label>
                                                                <div class="form-group files">
                                                                    <div class="attachment-holder animated fadeIn" v-cloak v-bind:key="attachment.id" v-for="attachment in attachments">
                                                                        <ul class="form-group">
                                                                            <li class="label label-primary">{{ attachment.name + ' (' + Number((attachment.size
                                                                                / 1024 / 1024).toFixed(1)) + 'MB)'}}</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label>【活動日時】</label>
                                                                <p>{{volunteer.activity_date}}</p>
                                                            </div>
                                                            <div>
                                                                <label>【締切日】</label>
                                                                <p>{{volunteer.deadline}}</p>
                                                            </div>
                                                            <div>
                                                                <label>【活動場所】</label>
                                                                <p>{{volunteer.activity_location}}</p>
                                                            </div>
                                                            <div>
                                                                <label>【募集人数】</label>
                                                                <p>{{volunteer.number_of_people}}</p>
                                                            </div>
                                                            <div>
                                                                <label>【オリエンテーションの有無】</label>
                                                                <p>{{volunteer.orientation}}</p>
                                                            </div>
                                                            <div>
                                                                <label>【費用負担】</label>
                                                                <p>{{volunteer.cost}}</p>
                                                            </div>
                                                            <div>
                                                                <label>【申込方法】</label>
                                                                <p>{{volunteer.subscription}}</p>
                                                            </div>
                                                            <div>
                                                                <label>【内容詳細】</label>
                                                                <p>{{volunteer.content}}</p>
                                                            </div>
                                                            <div>
                                                                <label>【関連URL】</label>
                                                                <p>{{volunteer.linkname}}</p>
                                                            </div>
                                                            <div>
                                                                <label>【問い合わせ先】</label>
                                                                <p v-html="volunteer.contact"></p>
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
                                    <button type="button" class="btn btn-outline-primary" @click.prevent="submitClicked">登録</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Progress Modal -->
                    <div class="modal" id="progressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                            aria-valuemax="100" v-bind:style="{ width: computedWidth }"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import VueDatepickerLocal from "vue-datepicker-local";
    import moment from "moment";
    import Multiselect from "vue-multiselect";

    export default {
        components: { VueDatepickerLocal, Multiselect },
        data() {
            return {
                volunteer: {
                    id: "",
                    subject: "",
                    activity_category: "",
                    children: true,
                    start_date: "",
                    end_date: "",
                    sponsor: "",
                    file: "",
                    activity_date: "",
                    deadline: "",
                    activity_location: "",
                    number_of_people: "",
                    orientation: "",
                    cost: "",
                    subscription: "",
                    content: "",
                    linkname: "",
                    contact: "",
                    deactivate: false,
                    updated_by: this.$store.state.user != null ? this.$store.state.user.id : 0,
                    created_by: this.$store.state.user != null ? this.$store.state.user.id : 0
                },
                edit: false,
                dateFormat: "YYYY-MM-DD",
                switchColorDeactivate: "#DC3545",
                switchColorOther: "#0066CC",
                volunteerDate: new Date(),
                range: [new Date(), new Date()],
                eventDateRange: [new Date(), new Date()],
                emptyTime: "",
                emptyRange: [],
                local: {
                    dow: 0, // Sunday is the first day of the week
                    hourTip: "Select Hour", // tip of select hour
                    minuteTip: "Select Minute", // tip of select minute
                    secondTip: "Select Second", // tip of select second
                    yearSuffix: "", // suffix of head year
                    monthsHead: "一月_二月_三月_四月_五月_六月_七月_八月_九月_十月_十一月_十二月".split(
                        "_"
                    ), // months of head
                    months: "一_二_三_四_五_六_七_八_九_十_十一_十二".split("_"), // months of panel
                    weeks: "日_月_火_水_木_金_土".split("_"), // weeks,
                    cancelTip: "cancel",
                    submitTip: "confirm"
                },
                // You can store all your files here
                attachments: [],
                attachment_labels: [], // List of old uploaded files coming from the server
                // Each file will need to be sent as FormData element
                uploadedData: new FormData(),
                percentCompleted: 0,
                tempRemovedFileIds: [],
                currentAddedFileIs: [],
                width: "0%",
                categories: [
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
                    { id: "2300", name: "その他区分" }
                ],
                selectedActivityCategory: null
            };
        },
        computed: {
            computedWidth: function () {
                return this.width;
            }
        },

        created() {
            console.log(this.$route.params);
            if (this.$route.params.model)
                this.fetchVolunteer(this.$route.params.model);

            if (this.$route.params.requestType === "edit") this.edit = true;
        },

        methods: {
            // Add new, sends model to API
            addVolunteer() {
                this.volunteer.file = this.currentAddedFileIs.join(",");

                let self = this;
                console.log(this.volunteer);

                if (this.edit === false) {
                    // Add
                    NProgress.start()
                    fetch("/api/volunteer", {
                        method: "post",
                        body: JSON.stringify(this.volunteer),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            NProgress.done();
                            self
                                .$swal({
                                    title: "登録完了!",
                                    text: "登録が完了しました!",
                                    type: "success",
                                    confirmButtonText: "OK"
                                })
                                .then(function () {
                                    self.$router.push({
                                        name: "noticeList"
                                    });
                                });
                        })
                        .catch(err => console.log(err));
                } else {
                    // Update
                    NProgress.start()
                    fetch("/api/volunteer", {
                        method: "put",
                        body: JSON.stringify(this.volunteer),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            NProgress.done();
                            self
                                .$swal({
                                    title: "登録完了!",
                                    text: "登録が完了しました!",
                                    type: "success",
                                    confirmButtonText: "OK"
                                })
                                .then(function () {
                                    self.$router.push({
                                        name: "noticeList"
                                    });
                                });
                        })
                        .catch(err => console.log(err));
                }
            },

            // Edit new, sends model to API
            fillFormWithRecievedModel(volunteer) {
                this.pullAttachments(volunteer);

                this.range = [new Date(volunteer.start_date), new Date(volunteer.end_date)]
                this.eventDateRange = [new Date(volunteer.event_start_date), new Date(volunteer.event_end_date)]

                console.log(this.categories.find(x => x.id === volunteer.activity_category))
                this.selectedActivityCategory = this.categories.find(x => x.id === volunteer.activity_category.toString())

                this.volunteer.id = volunteer.id;
                this.volunteer.subject = volunteer.subject;
                this.volunteer.activity_category = volunteer.activity_category;
                this.volunteer.children = volunteer.children == 1 ? true : false;
                this.volunteer.start_date = volunteer.start_date;
                this.volunteer.end_date = volunteer.end_date;
                this.volunteer.sponsor = volunteer.sponsor;
                this.volunteer.file = volunteer.file;
                this.volunteer.activity_date = volunteer.activity_date;
                this.volunteer.deadline = volunteer.deadline;
                this.volunteer.activity_location = volunteer.activity_location;
                this.volunteer.number_of_people = volunteer.number_of_people;
                this.volunteer.orientation = volunteer.orientation;
                this.volunteer.cost = volunteer.cost;
                this.volunteer.subscription = volunteer.subscription;
                this.volunteer.content = volunteer.content;
                this.volunteer.linkname = volunteer.linkname;
                this.volunteer.contact = volunteer.contact;
                this.volunteer.deactivate = volunteer.deactivate == 1 ? true : false;
                this.volunteer.created_by = volunteer.created_by;
                this.volunteer.updated_by = volunteer.updated_by;

                // For Files
                if (volunteer.file) this.currentAddedFileIs = volunteer.file.split(",");
            },

            // Analyzing attachmet file size
            getAttachmentSize() {
                this.upload_size = 0; // Reset to beginningƒ
                this.attachments.map(item => {
                    this.upload_size += parseInt(item.size);
                });
                this.upload_size = Number(this.upload_size.toFixed(1));
                this.$forceUpdate();
            },

            // Preparing files
            prepareFields() {
                for (var i = this.attachments.length - 1; i >= 0; i--) {
                    console.log(this.attachments[i].category_id);
                    this.uploadedData.append("attachments[][0]", this.attachments[i]);
                    this.uploadedData.append(
                        "attachments[][1]",
                        this.attachments[i].category_id
                    );
                }

                for (var i = this.attachment_labels.length - 1; i >= 0; i--) {
                    this.uploadedData.append(
                        "attachment_labels[]",
                        JSON.stringify(this.attachment_labels[i])
                    );
                }
            },

            // Removing attachment on button click
            removeAttachment(attachment) {
                console.log(attachment);
                if (attachment.id) this.tempRemovedFileIds.push(attachment.id);

                this.attachments.splice(this.attachments.indexOf(attachment), 1);
                this.getAttachmentSize();
            },

            // This function will be called every time you add a file
            uploadFieldChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length) return;

                for (var i = files.length - 1; i >= 0; i--) {
                    this.attachments.push(files[i]);
                }

                // Reset the form to avoid copying these files multiple times into this.attachments
                document.getElementById("attachments").value = [];
                console.log(attachments);
            },

            // Adding attachment, Sends request to Attachment API
            addAttachment() {
                this.prepareFields();

                var config = {
                    headers: { "Content-Type": "multipart/form-data" },
                    onUploadProgress: function (progressvolunteer) {
                        this.percentCompleted = Math.round(
                            progressvolunteer.loaded * 100 / progressvolunteer.total
                        );
                        console.log(this.percentCompleted);
                        this.width = this.percentCompleted + "%";
                        this.$forceUpdate();
                    }.bind(this)
                };

                //Make HTTP request to store announcement
                $("#progressModal").modal({ backdrop: "static" }, "show");
                axios
                    .post("/api/attachments/store", this.uploadedData, config)
                    .then(
                        function (response) {
                            console.log(response);
                            if (response.data.success) {
                                console.log("Successfull upload");
                                this.currentAddedFileIs.push(response.data.data);
                                this.resetData();
                                this.addVolunteer();
                                $("#progressModal").modal("hide");
                            } else {
                                console.log("Unsuccessful Upload");
                            }
                        }.bind(this)
                    ) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                    .catch(function (error) {
                        console.log("Attachment catch", error);
                    });
                console.log(attachments);
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
                    params: {
                        attachment_id: attachment_id
                    }
                };

                // Make HTTP request to store announcement
                axios
                    .delete("/api/attachments/", data)
                    .then(
                        function (response) {
                            console.log(response);
                            if (response.data.success) {
                                this.getAttachmentSize();
                            } else {
                                console.log(response.data.errors);
                            }
                        }.bind(this)
                    ) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            // Pull required attachmets
            pullAttachments(volunteer) {
                // Make HTTP request to store announcement
                axios
                    .get(`/api/asset/attachments/${volunteer.file}`)
                    .then(
                        function (response) {
                            console.log(response);
                            if (response.data.success) {
                                this.attachments = response.data.data;
                                console.log("Attachments: ", this.attachments);
                                this.getAttachmentSize();
                            } else {
                                console.log(response.data.errors);
                            }
                        }.bind(this)
                    ) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            // Final submisison clicked for form data
            submitClicked() {
                $("#confirmationModal").modal("hide");
                if (this.tempRemovedFileIds.length) {
                    this.tempRemovedFileIds.forEach(id => {
                        this.removeServerAttachment(id);
                        this.currentAddedFileIs.filter(item => item !== id);
                    });
                }

                if (this.attachments.length) this.addAttachment();
                else this.addVolunteer();
            },

            // Checking for validation and reconfirm opening modal
            confirm() {
                this.$validator.validate().then(result => {
                    if (!result) {
                        console.log("true");
                        // this.$swal({
                        //     title: "警告!",
                        //     text: "必須フィールドに記入してください",
                        //     type: "warning",
                        //     animation: false,
                        //     customClass: "animated tada",
                        //     confirmButtonText: "OK"
                        // });
                    } else {
                        this.volunteer.event_start_date = this.eventDateRange ? this.eventDateRange[0].toISOString().slice(0, 10) : "";
                        this.volunteer.event_end_date = this.eventDateRange ? this.eventDateRange[1].toISOString().slice(0, 10) : "";

                        this.volunteer.volunteer_date = moment(String(this.volunteerDate)).format("YYYY-MM-DD");
                        this.volunteer.start_date = !!this.range ? moment(String(this.range[0])).format("YYYY-MM-DD")
                            : "";
                        this.volunteer.end_date = !!this.range
                            ? moment(String(this.range[1])).format("YYYY-MM-DD")
                            : "";
                        $("#confirmationModal").modal("show");
                    }
                });
            },
            onActivityCategorySelect(selectedOption, id) {
                if (selectedOption) {
                    this.volunteer.activity_category = selectedOption.id
                    console.log(selectedOption.id)
                }
            },
            fetchVolunteer(model) {
                NProgress.start()

                fetch(`/api/volunteer/${model.id}`)
                    .then(res => res.json())
                    .then(res => {
                        this.fillFormWithRecievedModel(res.data);
                        console.log(res.data);
                        NProgress.done()
                    })
                    .catch(err => console.log(err))
            },
        }
    };
</script>