<template>
    <div>
        <h4>
            <span>
                <i class="fas fa-dove"></i>
            </span>会員募集 情報登録画面</h4>
        <hr>

        <div class="row">
            <div class="col-lg-12">
                <div class="bs-component">
                    <form action="" method="post">
                        <fieldset>
                            <div class="form-group col-lg-12">
								<label class="col-form-label" for="organizer">【団体名】（必須）</label>
								<input v-model="membership.organizer" class="form-control" id="organizer" type="text" v-validate="'required'" name="subject" data-vv-as="件名">
                                <span class="is-danger">{{ errors.first('organizer') }}</span>
							</div>
							<div  class="form-group col-lg-12">
								<label>【フォーマット】</label>
								<p>会員募集</p>
							</div>
							
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label">【掲載開始日】（必須）</label>
                                <div class="row">
                                    <vue-datepicker-local v-model="range" :local="local" :format="dateFormat"></vue-datepicker-local>
                                </div>
                            </div>

                            <div class="col-lg-12 form-group">
                                <label for="inputFile">【イメージ画像】</label>
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
							
                            <div class="form-group  col-lg-12">
								<label for="contents">【内容詳細】活動内容、上記の記入内容についての詳細・補足や、ボランティア保険について、持ち物、当日のスケジュール、雨天時の扱い、車での来場に関する扱い等をお書きください。</label>
                                <wysiwyg v-model="membership.content"  name="content" data-vv-as="掲載内容" type="text" />
							</div>
                            
                            
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label">【会費】</label>
                                <div class="col-lg-12 form-group">
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="membership.is_payment" value="0" color="primary-o" checked>無</p-radio>
                                    </div>
                                    <div class="form-group row">
                                        <p-radio class="p-default p-curve" v-model="membership.is_payment" value="1" color="primary-o">有</p-radio>
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-12  form-group" >
                                <div class="form-inline">
                                    <div class="form-group form-inline text-right">
                                        <label class="col-form-label" for="dues_price">
                                        </label>
                                        <input class="form-control " v-model="membership.membership_fee" :disabled="membership.is_payment == '0' ? true : false"  id="dues_price" type="text"  v-validate="'decimal'" name="membership_fee" data-vv-as="会費">&nbsp; 円  &nbsp; &nbsp;
                                      
                                    </div>
                                    <div class="form-check">
                                        <p-radio class="p-default p-curve" :disabled="membership.is_payment == '0' ? true : false" v-model="membership.payment_type" name="" value="月" color="primary-o" checked>月</p-radio>
                                        <p-radio class="p-default p-curve" :disabled="membership.is_payment == '0' ? true : false" v-model="membership.payment_type" value="年" color="primary-o">年</p-radio>
                                    </div>
                                    
                                </div>
                                  <span class="is-danger">{{ errors.first('membership_fee') }}</span>
                            </div>
							<div class="form-group  col-lg-12">
								【関連URL】
								<br>
								<input v-model="membership.linkname" class="form-control" id="linkname" type="text">
							</div>
							<div class="form-group  col-lg-12">
								<label for="contact">【問い合わせ先】電話番号、ファックス番号、メールアドレス、など。</label>
                                <wysiwyg v-model="membership.contact"  name="content" data-vv-as="掲載内容" type="text" />
							</div>

                            <div class="col-lg-12 form-group">
                                <label class="col-form-label">【サイトに公開する】</label>
                                <div class="form-group row">
                                    <toggle-button v-model="membership.deactivate" :width="60" :value="true" :color="switchColorDeactivate" :sync="true" :labels="{ checked: 'はい', unchecked: 'いいえ' }"
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
                                                                        <p>{{membership.organizer}}</p>
                                                                    </div>
                                                                    <div>
                                                                        <label>【フォーマット】</label>
                                                                        <p>会員募集</p>
                                                                    </div>
                                                                     <div>
                                                                        <label>【掲載開始日】</label>
                                                                        <p>{{membership.start_date}}</p>
                                                                    </div>
                                                                    <div>
                                                                        <label>【掲載終了日】</label>
                                                                        <p>{{membership.end_date}}</p>
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
                                                                        <label>【内容詳細】</label>
                                                                        <p v-html="membership.content"></p>
                                                                    </div>
                                                                    <div>
                                                                        <label>【会費】</label>
                                                                        <p>{{membership.is_payment === "0"? '無' : '有'}}</p>
                                                                    </div>
                                                                     <div v-if="membership.is_payment === '1'   ">
                                                                        <p>{{membership.membership_fee}}円 / {{membership.payment_type}}</p>
                                                                    </div>
                                                                    
                                                                    <div>
                                                                        <label>【関連URL】</label>
                                                                        <p>{{membership.linkname}}</p>
                                                                    </div>
                                                                    <div>
                                                                        <label>【問い合わせ先】</label>
                                                                        <p v-html="membership.contact"></p>
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
    import moment from "moment";
    import Multiselect from "vue-multiselect";

    export default {
        components: { VueDatepickerLocal, Multiselect },
        data() {
            return {
                membership: {
                    id: "",
                    organizer: "",
                    start_date: "",
                    end_date: "",
                    file: "",
                    content: "",
                    is_payment: "0",
                    amount: "",
                    payment_type: "月",
                    linkname: "",
                    contact: "",
                    deactivate: false,
                    created_by: 1,
                    updated_by: 1,
                },
                edit: false,
                dateFormat: "YYYY-MM-DD",
                switchColorDeactivate: "#DC3545",
                switchColorOther: "#0066CC",
                membershipDate: new Date(),
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
                categories: [
                    { id: "100", name: "保健・医療・福祉" },
                    { id: "200", name: "社会教育" },
                    { id: "300", name: "まちづくり" },
                    { id: "400", name: "文化・芸術・スポーツ" },
                    { id: "500", name: "環境保全" },
                    { id: "600", name: "災害救助" },
                    { id: "700", name: "地域安全" },
                    { id: "800", name: "人権・平和" },
                    { id: "900", name: "国際協力" },
                    { id: "1000", name: "男女共同参画社会" },
                    { id: "1100", name: "子どもの健全育成" },
                    { id: "1200", name: "NPO活動支援" },
                    { id: "1300", name: "情報化社会" },
                    { id: "1400", name: "科学技術" },
                    { id: "1500", name: "経済活性" },
                    { id: "1600", name: "職業能力・雇用" },
                    { id: "1700", name: "消費者保護" },
                    { id: "1800", name: "観光" },
                    { id: "1900", name: "農村漁村" },
                    { id: "2000", name: "条例に基づく活動" },
                    { id: "2100", name: "その他" }
                ],
                acitvityCategorySelected: "",
                isDisabled: true
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
            addMembership() {
                this.membership.file = this.currentAddedFileIs.join(",");

                let self = this;
                console.log(this.membership);

                if (this.edit === false) {
                    // Add
                    let loader = this.$loading.show();
                    fetch("api/membership", {
                        method: "post",
                        body: JSON.stringify(this.membership),
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
                    fetch("api/membership", {
                        method: "put",
                        body: JSON.stringify(this.membership),
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
            fillFormWithRecievedModel(membership) {
                this.pullAttachments(membership);

                this.range[0] = new Date(membership.start_date);
                this.range[1] = new Date(membership.end_date);

                this.membership.subject = membership.subject;
                this.membership.activity_category = membership.activity_category;
                this.membership.children = membership.children;
                this.membership.membership_date = membership.membership_date;
                this.membership.start_date = membership.start_date;
                this.membership.end_date = membership.end_date;
                this.membership.organizer = membership.organizer;
                this.membership.file = membership.file;
                this.membership.deadline = membership.deadline;
                this.membership.venue = membership.venue;
                this.membership.capacity = membership.capacity;
                this.membership.target = membership.target;
                this.membership.how_to_apply = membership.how_to_apply;
                this.membership.cost = membership.cost;
                this.membership.detail = membership.detail;
                this.membership.url = membership.url;
                this.membership.phone = membership.phone;
                this.membership.deactivate = !!membership.deactivate == 1 ? true : false;
                this.membership.created_by = membership.created_by;
                this.membership.updated_by = membership.updated_by;

                // For Files
                if (membership.file) this.currentAddedFileIs = membership.file.split(",");
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
                    onUploadProgress: function (progressmembership) {
                        this.percentCompleted = Math.round(
                            progressmembership.loaded * 100 / progressmembership.total
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
                                this.addMembership();
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
            pullAttachments(membership) {
                // Make HTTP request to store announcement
                axios
                    .get(`api/asset/attachments/${membership.file}`)
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
                else this.addMembership();
            },

            // Checking for validation and reconfirm opening modal
            confirm() {
                this.$validator.validate().then(result => {
                    if (!result) {
                        console.log("true");
                        this.$swal({
                            title: "警告!",
                            text: "必須フィールドに記入してください",
                            type: "warning",
                            animation: false,
                            customClass: "animated tada",
                            confirmButtonText: "OK"
                        });
                    } else {
                        
                        this.membership.start_date = !!this.range
                            ? moment(String(this.range[0])).format("YYYY-MM-DD")
                            : "";
                        this.membership.end_date = !!this.range
                            ? moment(String(this.range[1])).format("YYYY-MM-DD")
                            : "";
                        $("#confirmationModal").modal("show");
                    }
                });
            },
            onSelect(selectedOption, id) {
                if(selectedOption){
                    this.membership.activity_category = selectedOption.id
                    console.log(selectedOption.id)
                }
            },
            onChange(value, srcmembership){
                //console.log(value)
                isDisabled = value
            }
        }
    };
</script>
