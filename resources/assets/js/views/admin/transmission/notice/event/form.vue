<template>
    <div>
        <h4>
            <span>
                <i class="fas fa-dove"></i>
            </span>イベント 情報登録画面</h4>
        <hr>

        <div class="row">
            <div class="col-lg-12">
                <div class="bs-component">
                    <form action="" method="post">
                        <fieldset>
                            <div class="form-group col-lg-12">
                                <label class="col-form-label" for="subject">【件名】（必須）</label>
                                <input v-model="event.subject" class="form-control" id="subject" type="text" v-validate="'required'" name="subject" data-vv-as="件名">
                                <span class="is-danger">{{ errors.first('subject') }}</span>
                            </div>
                            <div class="col-lg-12">
                                <label>【フォーマット】</label>
                                <p>イベント</p>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-lg-4">
                                    <label for="active_category">【活動カテゴリ】（必須）</label>
                                    <multiselect 
                                        v-model="selectedActivityCategory" 
                                        :options="categories" 
                                        @select="onSelect"  
                                        track-by="id" 
                                        label="name" 
                                        placeholder="選んでください" 
                                        selectLabel="クリックして選択する" 
                                        deselectLabel="クリックして選択を解除する" 
                                        selectedLabel="選ばれた" 
                                        v-validate="'required'" 
                                        name="activity_category" 
                                        data-vv-as="活動カテゴリ">
                                    </multiselect>
                                    <span class="is-danger">{{ errors.first('activity_category') }}</span>
                                </div>
                                <div class="form-group col-sm-12 col-lg-4">
                                    <label class="col-form-label">【開催日】（必須）</label>
                                    <div class="row">
                                        <vue-datepicker-local v-model="eventDate" :local="local" :format="dateFormat"></vue-datepicker-local>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-lg-4">
                                    <label class="col-form-label">【掲載開始日】（必須）</label>
                                    <div class="row">
                                        <vue-datepicker-local v-model="range" :local="local" :format="dateFormat"></vue-datepicker-local>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 form-group">
                                <label class="col-form-label">【子供の参加】</label>
                                <div class="form-group row">
                                    <toggle-button v-model="event.children" :width="60" :value="true" :color="switchColorOther" :sync="true" :labels="{ checked: 'はい', unchecked: 'いいえ' }"
                                    />
                                </div>
                            </div>

                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="sponsor">【主催】</label>
                                <input v-model="event.organizer" class="form-control" id="sponsor" type="text" v-validate="'required'" name="organizer" data-vv-as="主催">
                                <span class="is-danger">{{ errors.first('organizer') }}</span>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label for="inputFile">【添付ファイル】</label>
                                <div class="file-upload">
                                    <div class="form-group">
                                        <label class="btn btn-outline-primary btn-sm" for="attachments">
                                            <input type="file" multiple="multiple" accept="image/*" id="attachments" style="display: none" @change="uploadFieldChange"> 参照
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
                                <label class="col-form-label" for="deadline">【締切日】例）先着順、締切日、など。</label>
                                <input v-model="event.deadline" class="form-control" id="deadline" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="venue">【会場】</label>
                                <input v-model="event.venue" class="form-control" id="venue" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="capacity">【定員】</label>
                                <input v-model="event.capacity" class="form-control" id="capacity" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="target">【対象者】例）18才以上、関心のある方、など。</label>
                                <input v-model="event.target" class="form-control" id="target" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="subscription">【申込方法】例）事前に電話、当日来場可、等の申込方法。</label>
                                <input v-model="event.how_to_apply" class="form-control" id="subscription" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="cost">【費用】例）お弁当代○円、集合場所からイベント会場までの交通費、参加費、等。</label>
                                <input v-model="event.cost" class="form-control" id="cost" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label for="contents">【内容詳細】</label>
                                <wysiwyg v-model="event.detail" type="text" />
                            </div>
                            <div class="col-lg-12 form-group">
                                【関連URL】
                                <br>
                                <input v-model="event.url" class="form-control" id="linkname" type="text">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label for="contact">【問い合わせ先】電話番号、ファックス番号、メールアドレス、など。</label>
                                <!-- <textarea v-model="event.phone" class="form-control" id="contact" required="" rows="3"></textarea> -->
                                <wysiwyg v-model="event.phone"  name="content" data-vv-as="掲載内容" type="text" />
                            </div>

                            <div class="col-lg-12 form-group">
                                <label class="col-form-label">【サイトに公開する】</label>
                                <div class="form-group row">
                                    <toggle-button v-model="event.deactivate" :width="60" :value="true" :color="switchColorDeactivate" :sync="true" :labels="{ checked: 'はい', unchecked: 'いいえ' }"
                                    />
                                </div>
                            </div>

                            <router-link :to="{ name: 'noticeList' }">
                                <button class="btn btn-outline-primary">戻る</button>
                            </router-link>

                            <button type="button" class="btn btn-primary" @click="confirm">
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
                                                </span>イベント情報 登録確認画面
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
                                                                        <p>{{event.subject}}</p>
                                                                    </div>
                                                                    <div>
                                                                        <label>【フォーマット】</label>
                                                                        <p>イベント</p>
                                                                    </div>
                                                                    <div>
                                                                        <label>【活動カテゴリ】</label>
                                                                        <p>{{selectedActivityCategory? selectedActivityCategory.name : ''}}</p>
                                                                        
                                                                    </div>
                                                                    <div>
                                                                        <label>【子供の参加】</label>
                                                                        <p>{{!!event.children === true? 'はい' : 'いいえ'}}</p>
                                                                    </div>
                                                                    <div>
                                                                        <label>【開催日】</label>
                                                                        <p>{{event.event_date}}</p>
                                                                    </div>
                                                                    <div>
                                                                        <label>【掲載開始日】</label>
                                                                        <p>{{event.start_date}}</p>
                                                                    </div>
                                                                    <div>
                                                                        <label>【掲載終了日】</label>
                                                                        <p>{{event.end_date}}</p>
                                                                    </div>
                                                                    <div>
                                                                        <label>【主催】</label>
                                                                        <p>{{event.organizer}}</p>
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
                                                                        <label>【締切日】</label>
                                                                        <p>{{event.deadline}}</p>
                                                                    </div>
                                                                    <div>
                                                                        <label>【会場】</label>
                                                                        <p>{{event.venue}}</p>
                                                                    </div>
                                                                    <div>
                                                                        <label>【定員】</label>
                                                                        <p>{{event.capacity}}</p>
                                                                    </div>
                                                                    <div>
                                                                        <label>【対象者】</label>
                                                                        <p>{{event.target}}</p>
                                                                    </div>
                                                                    <div>
                                                                        <label>【申込方法】</label>
                                                                        <p>{{event.how_to_apply}}</p>
                                                                    </div>
                                                                    <div>
                                                                        <label>【費用】</label>
                                                                        <p>{{event.cost}}</p>
                                                                    </div>
                                                                    <div>
                                                                        <label>【内容詳細】</label>
                                                                        <p v-html="event.detail"></p>
                                                                    </div>
                                                                    <div>
                                                                        <label>【関連URL】</label>
                                                                        <p>{{event.url}}</p>
                                                                    </div>
                                                                    <div>
                                                                        <label>【問い合わせ先】</label>
                                                                        <p v-html="event.phone"></p>
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
                                            <button type="button" class="btn btn-outline-primary" @click="submitClicked">登録</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Progress Modal -->
                            <div class="modal fade" id="progressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import VueDatepickerLocal from "vue-datepicker-local";
    import Multiselect from "vue-multiselect";

    export default {
        components: { VueDatepickerLocal, Multiselect },
        data() {
            return {
                event: {
                    id: "",
                    subject: "",
                    activity_category: "",
                    children: true,
                    event_date: "",
                    start_date: "",
                    end_date: "",
                    organizer: "",
                    file: "",
                    deadline: "",
                    venue: "",
                    capacity: "",
                    target: "",
                    how_to_apply: "",
                    cost: "",
                    detail: "",
                    url: "",
                    phone: "",
                    deactivate: false,
                    created_by: 1,
                    updated_by: 1
                },
                edit: false,
                dateFormat: "YYYY-MM-DD",
                switchColorDeactivate: "#DC3545",
                switchColorOther: "#0066CC",
                eventDate: new Date(),
                range: [new Date(), new Date()],
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
                categories:[
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
                selectedActivityCategory: ""
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
                this.fillFormWithRecievedModel(this.$route.params.model);

            if (this.$route.params.requestType === "edit") this.edit = true;
        },

        methods: {
            // Add new, sends model to API
            addevent() {
                this.event.file = this.currentAddedFileIs.join(",");

                let self = this;
                console.log(this.event);

                if (this.edit === false) {
                    // Add
                    let loader = this.$loading.show();
                    fetch("api/event", {
                        method: "post",
                        body: JSON.stringify(this.event),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            loader.hide();
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
                    let loader = this.$loading.show();
                    fetch("api/event", {
                        method: "put",
                        body: JSON.stringify(this.event),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            loader.hide();
                            self
                                .$swal({
                                    title: "成功!",
                                    text: "活動センターが追加されました!",
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
            fillFormWithRecievedModel(event) {
                this.pullAttachments(event);

                this.range[0] = new Date(event.start_date);
                this.range[1] = new Date(event.end_date);

                this.event.subject = event.subject;
                this.event.activity_category = event.activity_category;
                this.event.children = event.children;
                this.event.event_date = event.event_date;
                this.event.start_date = event.start_date;
                this.event.end_date = event.end_date;
                this.event.organizer = event.organizer;
                this.event.file = event.file;
                this.event.deadline = event.deadline;
                this.event.venue = event.venue;
                this.event.capacity = event.capacity;
                this.event.target = event.target;
                this.event.how_to_apply = event.how_to_apply;
                this.event.cost = event.cost;
                this.event.detail = event.detail;
                this.event.url = event.url;
                this.event.phone = event.phone;
                this.event.deactivate = !!event.deactivate == 1 ? true : false;
                this.event.created_by = event.created_by;
                this.event.updated_by = event.updated_by;

                // For Files
                if (event.file) this.currentAddedFileIs = event.file.split(",");
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
                    onUploadProgress: function (progressEvent) {
                        this.percentCompleted = Math.round(
                            progressEvent.loaded * 100 / progressEvent.total
                        );
                        console.log(this.percentCompleted);
                        this.width = this.percentCompleted + "%";
                        this.$forceUpdate();
                    }.bind(this)
                };

                //Make HTTP request to store announcement
                $("#progressModal").modal({ backdrop: "static" }, "show");
                axios.post("/api/attachments/store", this.uploadedData, config)
                    .then(
                        function (response) {
                            console.log(response);
                            if (response.data.success) {
                                console.log("Successfull upload");
                                this.currentAddedFileIs.push(response.data.data);
                                this.resetData();
                                this.addevent();
                                $("#progressModal").modal("hide");
                            } else {
                                console.log("Unsuccessful Upload");
                            }
                        }.bind(this)
                    ) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                    .catch(error => {
                        if (error.response) {
                            console.log(error.response);
                            if(error.response.status === 413){
                                $("#progressModal").modal("hide");
                                 this.$swal({
                                    title: "警告!",
                                    text: "必須フィールドに記入してください",
                                    type: "warning",
                                    animation: false,
                                    customClass: "animated tada",
                                    confirmButtonText: "OK"
                                });
                            }
                                
                        }
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
            pullAttachments(event) {
                // Make HTTP request to store announcement
                axios
                    .get(`api/asset/attachments/${event.file}`)
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
                else this.addevent();
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
                        this.event.event_date = this.eventDate.toISOString().slice(0,10)
                        this.event.start_date = !!this.range
                            ? this.range[0].toISOString().slice(0,10)
                            : "";
                        this.event.end_date = !!this.range
                            ? this.range[1].toISOString().slice(0,10)
                            : "";
                        $("#confirmationModal").modal("show");
                    }
                });
            },
            onSelect(selectedOption, id) {
                if(selectedOption){
                    this.event.activity_category = selectedOption.id
                    console.log(selectedOption.id)
                }
            }
        }
    };
</script>
