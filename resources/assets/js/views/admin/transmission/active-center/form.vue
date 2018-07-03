<template>
    <div>
        <h4>
            <span>
                <i class="fas fa-dove"></i>
            </span> 宮崎市民活動センターからのお知らせ 情報登録画面</h4>
        <hr>
        
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="bs-component">
                    <form @submit.prevent="submitClicked">
                        <fieldset>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="subject">【件名】（必須）</label>
                                <input class="form-control" v-model="activeCenter.title" placeholder="件名" id="subject" v-validate="'required'" name="title" data-vv-as="件名" type="text">
                                <span class="is-danger">{{ errors.first('title') }}</span>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="txtDate">【掲載開始日】（必須）</label>    
                                <div class="row">
                                    <vue-datepicker-local  v-model="range" :local="local" :format="dateFormat"></vue-datepicker-local>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="description">【掲載内容】</label>
                                <wysiwyg v-model="activeCenter.content"  v-validate="'required'" name="content" data-vv-as="掲載内容" type="text"/>
                                <span class="is-danger">{{ errors.first('content') }}</span>
                            </div>
                             <div class="col-lg-12 form-group">
                                <label class="col-form-label">【サイトに公開する】</label>
                                <div class="form-group row">
                                    <toggle-button v-model="activeCenter.deactivate" :width="60" :value="true" :color="switchColorDeactivate" :sync="true" :labels="{ checked: '非公開', unchecked: '公開' }"
                                    />
                                </div>
                            </div>
                             <div class="col-lg-12 form-group">
                                <label for="inputFile">【添付ファイル】</label>
                                <div class="file-upload">
                                    <div class="form-group">
                                        <label class="btn btn-outline-primary btn-sm" for="attachments">
                                             <input type="file" multiple="multiple" id="attachments" style="display: none" @change="uploadFieldChange">
                                            参照
                                        </label>
                                        
                                        <div class="form-group files">
                                            <div class="attachment-holder animated fadeIn" v-cloak v-bind:key="attachment.id" v-for="attachment in attachments"> 
                                                <div class="form-group">
                                                    <button class="btn btn-outline-danger btn-sm" @click.prevent="removeAttachment(attachment)">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                    <span class="label label-primary">{{ attachment.name + ' (' + Number((attachment.size / 1024 / 1024).toFixed(1)) + 'MB)'}}</span> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <router-link :to="{ name: 'activeCenterList' }">
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
                                        </span> 宮崎市民活動センターからのお知らせ 登録確認画面
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
                                                                    <p>{{activeCenter.title}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【掲載開始日】</label>
                                                                    <p>{{activeCenter.start_date}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【掲載終了日】</label>
                                                                    <p>{{activeCenter.end_date}}</p>
                                                                </div>
                                                                <div class="wrapper">
                                                                    <label>【掲載内容】</label>
                                                                    <p class="main" v-html="activeCenter.content"></p>
                                                                </div>
                                                                <div>
                                                                    <label>【添付ファイル】</label>
                                                                    <div class="form-group files">
                                                                        <div class="attachment-holder animated fadeIn" v-cloak v-bind:key="attachment.id" v-for="attachment in attachments"> 
                                                                            <ul class="form-group">
                                                                                <li class="label label-primary">{{ attachment.name + ' (' + Number((attachment.size / 1024 / 1024).toFixed(1)) + 'MB)'}}</li> 
                                                                            </ul>
                                                                        </div>
                                                                    </div>
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
                                        <button type="button" class="btn btn-outline-primary" @click="submitClicked" >登録</button>
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
    import moment from 'moment'

    export default {
        components: { VueDatepickerLocal },
        data() {
            return {
                activeCenter: {
                    id: "",
                    title: "",
                    start_date: "",
                    end_date: "",
                    content: "",
                    file: "",
                    deactivate: false,
                    created_by: 1,
                    updated_by: 1
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
                width:'0%'
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
            
            if(this.$route.params.requestType === 'edit')
                this.edit = true
        },

        methods: {
            // Add new, sends model to API
            addActiveCenter() {
                this.activeCenter.file = this.currentAddedFileIs.join(',')

                let self = this
                console.log(this.activeCenter)

                if (this.edit === false) {
                    // Add
                    let loader = this.$loading.show()
                    fetch("/api/active-center", {
                        method: "post",
                        body: JSON.stringify(this.activeCenter),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        loader.hide()
                        self.$swal({
                            title: "登録完了!",
                            text: "登録が完了しました!",
                            type: "success",
                            confirmButtonText : 'OK'
                        })
                        .then(function() {
                            self.$router.push({
                                name: 'activeCenterList'
                            })
                        });
                    })
                    .catch(err => console.log(err))
                } else {

                    // Update
                    let loader = this.$loading.show()
                    fetch("/api/active-center", {
                        method: "put",
                        body: JSON.stringify(this.activeCenter),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        loader.hide()
                        self.$swal({
                            title: "成功!",
                            text: "活動センターが追加されました!",
                            type: "success",
                            confirmButtonText : 'OK'
                        })
                        .then(function() {
                            self.$router.push({
                                name: 'activeCenterList'
                            })
                        });
                    })
                    .catch(err => console.log(err))
                }
            },

            // Edit new, sends model to API
            fillFormWithRecievedModel(activeCenter) {
                this.pullAttachments(activeCenter);

                this.range[0] = new Date(activeCenter.start_date)
                this.range[1] = new Date(activeCenter.end_date)
                
                this.activeCenter.id = activeCenter.id
                this.activeCenter.title = activeCenter.title
                this.activeCenter.start_date = activeCenter.start_date
                this.activeCenter.end_date = activeCenter.end_date
                this.activeCenter.content = activeCenter.content
                this.activeCenter.file = activeCenter.file
                this.activeCenter.deactivate = !! activeCenter.deactivate == 1 ? true:false
                this.activeCenter.created_by = activeCenter.created_by
                this.activeCenter.updated_by = activeCenter.updated_by

                // For Files
                if(activeCenter.file)
                    this.currentAddedFileIs = activeCenter.file.split(',')
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
                if(attachment.id)
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
                    headers: { 'Content-Type': 'multipart/form-data' } ,
                    onUploadProgress: function(progressEvent) {
                        this.percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total )
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
                        this.addActiveCenter()
                         $("#progressModal").modal('hide')
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
            removeServerAttachment(attachment_id){
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
            pullAttachments(activeCenter) {
                // Make HTTP request to store announcement
                axios.get(`/api/asset/attachments/${activeCenter.file}`).then(function (response) {
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
            submitClicked(){
                $("#confirmationModal").modal('hide')
                if(this.tempRemovedFileIds.length){
                    this.tempRemovedFileIds.forEach(id => {
                        this.removeServerAttachment(id)
                        this.currentAddedFileIs.filter(item => item !== id)
                    })
                }

                if(this.attachments.length)
                    this.addAttachment()
                else
                    this.addActiveCenter()
            },

            // Checking for validation and reconfirm opening modal
            confirm(){
                this.$validator.validate().then(result => {
                    if (!result) {
                        console.log('true')
                    }
                    else{
                        this.activeCenter.start_date = !!this.range ? moment(String(this.range[0])).format("YYYY-MM-DD") : ""
                        this.activeCenter.end_date = !!this.range ? moment(String(this.range[1])).format("YYYY-MM-DD") : ""
                        $("#confirmationModal").modal('show')
                    }
                });
            }
        }
    };
</script>