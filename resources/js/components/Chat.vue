<template>
    <div>
        <div class="modal d-block" id="add-avatar" v-if="visibles_avatar">
            <div class="modal-dialog">
                <div class="modal-content" style="background-color: #13143e;">
                    <div class="modal-card">
                        <header class="modal-header">
                            <p class="modal-title">
                                Upload Avatar Image for Livestreaming
                            </p>
                        </header>

                        <div class="modal-body">
                            <figure class="mr-6 image is-64x64 d-inline" v-for="(image, key) in dataImages">
                                <a href="javascript:void(0)" @click="selectImage(image.src)">
                                    <img :src="image.src" class="s-rounded mr-6" width="50" />
                                </a>
                            </figure>

                            <form @submit.prevent="submitAvatar">
                                <div class="columns">
                                    <div class="column">
                                        <div class="field">
                                            <label class="label">
                                                Something Else
                                            </label>

                                            <div class="control">
                                                <figure class="mr-6 image is-128x128 is-inline-flex">
                                                    <img :src="avatar_preview_image" v-if="avatar_preview_image" class="mr-6" width="50" />
                                                    <img src="https://bulma.io/images/placeholders/128x128.png" v-else
                                                        class="mr-6" width="50" />
                                                </figure>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="column">
                                        <div class="field">
                                            <label class="label">Avatar File</label>
                                            <div class="control">
                                                <input type="file" accept="image/*" v-on:change="uploadAvatarImage">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="field">
                                            <div class="control">
                                                <button type="submit" class="btn btn-success m-1">
                                                    Submit
                                                </button>

                                                <button type="button" class="btn btn-danger" @click="modelClose">
                                                    Cancel
                                                </button>
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

        <div class="modal-backdrop fade show" v-show="visibles_avatar"></div>

        <button id="myBtn" class="open-button chat-btn btn btn-danger" @click="openChat()" v-if="open" title="Click to start chat">
            Chat
        </button>

        <div class="chat-popup" v-if="visibles">
            <div class="form-container card">
                <div class="card-header d-flex justify-content-between align-items-center p-2">
                    <a href="#!">
                        <i class="bx bx-window-close text-dark" @click="closeChat()" style="font-size: 20px;"></i>
                    </a>

                    <h5 class="text-dark mt-2">{{ livestream.name }}</h5>

                    <span
                        class="up-avatar text-white p-1 bg-danger rounded fs-12 fw-bold"
                        @click="updateAvatarImages()"
                        v-show="avatar_image_view"
                    >
                        Edit Avatar
                    </span>

                    <span
                        class="up-avatar text-white p-1 bg-danger rounded fs-12 fw-bold"
                        v-show="!avatar_image_view"
                        @click="joinchatRoom()"
                    >
                        Browse Avatar
                    </span>
                </div>

                <div
                    class="card-body"
                    id="chat-box-container"
                    data-mdb-perfect-scrollbar="true"
    				style="position: relative; max-height: 500px; height:350px; overflow-y: scroll;"
                >
                    <div v-for="(message, num) in messages">
                        <div
                            class="d-flex flex-row justify-content-start"
                            v-if="message.user.id != user_details.id" :ref="num === messages.length ? 'last' : undefined"
                        >
                            <img
                                v-if="message.avatars.length > 0"
                                :src="message.avatars[0].avatar_image"
                                class="rounded-circle"
                                style="width: 35px; height: 100%;"
                            />

                            <img
                                v-else
                                src="/assets/front/images/avatar.jpg"
                                class="rounded-circle"
                                style="width: 35px; height: 100%;"
                            />

                            <div>
                                <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">
                                    <span v-if="! message.file_type">
                                        {{ message.message.slice(0, 100) }}

                                        <i v-if="message.isOpen">
                                            {{ message.message.slice(100) }}
                                        </i>

                                        <a v-if="message.message.length > 100"
                                            class="toggleBtn"
                                            @click="toggleItem(num)"
                                            href="javascript:void(0)"
                                        >
                                            Read More...
                                        </a>
                                    </span>

                                    <span v-if="message.file_type" style="margin-right: 15px;">
                                        Download {{ message.file_type }}
                                    </span>

                                    <a
                                        v-if="message.file_type"
                                        :href="message.link + '/' + message.file"
                                        title="Download file"
                                        target="_blank"
                                    >
                                        <i class="bx lni-download" style="color: #979191; font-size: 17px;"></i>
                                    </a>
                                </p>

                                <p class="small ms-3 mb-3 rounded-3 text-muted">
                                    {{ message.user.username }} - {{ message.createAt }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="d-flex flex-row justify-content-end"
                            v-else
                            :ref="num === messages.length ? 'last' : undefined"
                        >
                            <div>
                                <p
                                    class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary"
                                >
                                    <span v-if="!message.file_type">
                                        {{ message.message.slice(0, 100) }}
                                        <i v-if="message.isOpen">
                                            {{ message.message.slice(100) }}
                                        </i>

                                        <a
                                            v-if="message.message.length > 100"
                                            class="toggleBtn"
                                            @click="toggleItem(num)"
                                            href="javascript:void(0)"
                                        >
                                            Read More...
                                        </a>
                                    </span>

                                    <span v-if="message.file_type" style="margin-right: 15px;">
                                        Download {{ message.file_type }}
                                    </span>

                                    <a
                                        v-if="message.file_type"
                                        :href="message.link + '/' + message.file"
                                        title="Download file"
                                        target="_blank"
                                    >
                                        <i class="bx lni-download" style="font-size: 17px;"></i>
                                    </a>
                                </p>

                                <p class="small me-3 mb-3 rounded-3 text-muted d-flex justify-content-end">
                                    {{ message.createAt }}
                                </p>
                            </div>

                            <img
                                v-if="avatar_image_view"
                                :src="avatar_image_view"
                                class="rounded-circle"
                                style="width: 35px; height: 100%;"
                            >

                            <img
                                v-else
                                src="/assets/front/images/avatar.jpg"
                                class="rounded-circle"
                                style="width: 35px; height: 100%;"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3 bg-info1">
                    <img
                        v-if="avatar_image_view"
                        :src="avatar_image_view"
                        class="rounded-circle"
                        style="width: 35px; height: 100%;"
                    >

                    <img
                        v-else
                        src="/assets/front/images/avatar.jpg"
                        class="rounded-circle"
                        style="width: 35px; height: 100%;"
                    />

                    <input
                        v-if="add_image_btn"
                        v-model="text"
                        ref="chatInput"
                        class="form-control form-control-lg border-none chat-input"
                        placeholder="Type message"
                        @keydown.enter.prevent.stop="submit(e)"
                        @keydown.space="handleSpace"
                    >

                    <a
                        href="#!"
                        class="ms-1 text-dark"
                        @click="attach_lists = !attach_lists"
                        v-show="add_image_btn"
                    >
                        <i class="bx bx-paperclip" style="font-size: 20px;"></i>
                    </a>
                    <input type="file" ref="fileInput" :accept="this.accept" style="display: none" @change="uploadFile">

                    <transition name="fade">
                        <ul class="file-btn-lists" v-show="attach_lists">
                            <li
                                title="Upload image"
                                :class="[(this.file_type == 'image') ? 'active' : '']"
                            >
                                <a @click="handleUploadClick('image')"
                                    v-show="add_image_btn"
                                >
                                    <i class="bx bx-upload share-icon-pop"
                                        style="font-size: 20px;"
                                        aria-hidden="true"
                                    ></i>
                                </a>
                            </li>

                            <li
                                title="Upload Video"
                                :class="[(this.file_type == 'video') ? 'active' : '']"
                            >
                                <a
                                    @click="handleUploadClick('video')"
                                    v-show="add_image_btn"
                                >
                                    <i
                                        class="bx bxs-video share-icon-pop"
                                        style="font-size: 20px;"
                                        aria-hidden="true"
                                    ></i>
                                </a>
                            </li>

                            <li
                                title="Upload Pdf"
                                :class="[(this.file_type == 'pdf') ? 'active' : '']"
                            >
                                <a
                                    @click="handleUploadClick('pdf')"
                                    v-show="add_image_btn"
                                >
                                    <i
                                        class="bx bxs-file-pdf share-icon-pop"
                                        style="font-size: 20px;"
                                        aria-hidden="true"
                                    ></i>
                                </a>
                            </li>
                        </ul>
                    </transition>

                    <Picker
                        :native="true"
                        :display-recent="false"
                        picker-type="textarea"
                        ref="emojis"
                        class="ms-1 text-dark"
                        @update:text="onChangeText"
                        v-if="add_image_btn"
                        @keydown.enter.prevent="submit(e)"
                        @select="onSelectEmoji"
                        @keydown.space="handleSpace"
                        style="height: 100%; width: 100%;"
                    >
                        <i class="bx bx-smile" style="font-size: 20px;"></i>
                    </Picker>

                    <a href="#!" class="ms-1 text-dark" @click="submit()" v-show="add_image_btn">
                        <i class="bx bx-paper-plane" style="font-size: 20px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import css
import "../../../node_modules/vue3-emoji-picker/dist/style.css";
import { ref } from "../../../node_modules/vue";





export default {
    props: ['user_details', 'livestm', 'user_lists', 'filters'],
    data() {
        return {
            userId: Math.random().toString(36).slice(-5),
            messages: [],
            newMessage: '',
            userlists: [],
            search: '',
            visibles: false,
            open: true,
            avatar_image: '',
            old_avatar_image:'',
            checkbox: true,
            avatar_details: false,
            avatar_username: '',
            avatar_message: '',
            allowChange: true,
            user_livestream: false,
            visibles_avatar: false,
            add_image_btn: true,
            avatar_upload_image: '',
            avatar_preview_image: '',
            avatar_image_view: '',
            dataImages: [],
            update_images: false,
            total_chat: 0,
            livestream_id: '',
            scrollTop: 0,
            text: '',
            input: '',
            showpicker: true,
            submit_text: false,
            wordsToFilter: [],
            attach_lists: false,
            file: '',
            file_type: '',
            accept: '',
            add_file:false,
            livestream:'',
            submit_text_form:true,
            foundWord:'',




        }
    },
    created() {
        var vm = this;
        vm.livestream = this.livestm;
        vm.livestream_id = vm.livestream.id;


    },

    mounted() {

        document.addEventListener("click", e => {
            if (e.target.src) {
                if (this.submit_text == true) {
                    this.submit_text = false;
                    this.add_image_btn = false;
                    this.$nextTick(() => {
                        this.add_image_btn = true;
                    });
                }

            }
        })
        this.$nextTick(() => {
                    this.text= '';

        });

        axios.get('/filters/').then((response) => {
            this.wordsToFilter = response.data.data;
        });
        var vm = this;

        this.getChatMessage()

        // to connect the public channel
        window.Echo.channel('chat-room').listen('.new-message', (e) => {

            if (vm.livestream.id === e.chat.livestreams_id) {
                if(!this.text){
                    this.submit_text = false;
                    this.add_image_btn = false;
                    this.$nextTick(() => {
                        this.add_image_btn = true;
                   });
              }
                let time = vm.livestream.delay_time ? (vm.livestream.delay_time * 1000) : 1000;
                setTimeout(function () {
                    e.chat.isOpen = false;
                    vm.messages.push(e.chat)
                }, time);
            }
        })
        window.Echo.channel('chat-delay').listen('.chat-delay', (e) => {
            vm.livestream = ' ';
            vm.livestream = e.livestream;
            if(e.livestream.status == 'stopped'){
                document.getElementById('btn-bet').style.display = 'none';
                document.getElementById('data-table').style.display = 'none';

                this.visibles = false;
                this.open = false;
            }
        });
        window.Echo.channel('twitch-room').listen('.twitch-room', (e) => {
            vm.livestream = ' ';
            vm.livestream = e.livestream;
            if(e.livestream.status == 'stopped'){
                document.getElementById('btn-bet').style.display = 'none';
                document.getElementById('data-table').style.display = 'none';
                this.visibles = false;
                this.open = false;
            }
        });






    },
    computed: {
        containsSpam() {
            var vm = this;

            if(vm.text){
                // List of spam words
                const spamWords = this.wordsToFilter;
                vm.foundWord = spamWords.find(word => this.text.toLowerCase().includes(word.toLowerCase()))
                if(vm.foundWord !== null) {
                    // If found, store the spam word to display it in the message
                    vm.spamWord = vm.foundWord
                    return true
                }
                return false
            }

    }
  },
    methods: {

        toggleItem(index) {
        this.messages[index].isOpen = !this.messages[index].isOpen;
        },
        getChatMessage() {
            var vm = this;
            axios.get('/message/' + this.livestream.id).then((response) => {
                vm.scrollToEnd();
                vm.messages = response.data.data;

                 vm.messages.forEach(item => {
                    item.isOpen = false;
                 });
                console.log(vm.dataImages);
                vm.dataImages = response.data.images;
                if (response.data.avatar) {
                    vm.avatar_image = response.data.avatar.avatar_image
                    vm.avatar_image_view = response.data.avatar.avatar_image;
                }
                vm.total_chat = response.data.mychat;

                vm.getUserLivestrea(vm.livestream.id);


            }, (error) => {
                console.log(error);
            })
        },
        openChat() {
            this.add_image_btn = true;
            this.visibles = true;
            this.open = false;

            this.$nextTick(() => {
                var chatBoxContainer = document.getElementById('chat-box-container')
                if (chatBoxContainer) {
                    chatBoxContainer.scrollTo(0, chatBoxContainer.scrollHeight);
                }
            });
        },
        closeChat() {
            this.visibles = false;
            this.open = true;

        },
        async submitAvatar() {

            var vm = this;

            // if(vm.avatar_username && vm.avatar_image){
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let formData = new FormData();
            formData.append('avatar_image', vm.avatar_image);
            formData.append('user_id', vm.user_details.id);
            formData.append('livestreams_id', vm.livestream.id);

            axios.post('/livestream-user', formData, config).then((response) => {

                vm.getUserLivestrea(vm.livestream.id);
                vm.visibles_avatar = false;
                vm.visibles = true
                vm.add_image_btn = true;
                vm.open = false;

                vm.$nextTick(() => {
                    var chatBoxContainer = document.getElementById('chat-box-container')
                    if (chatBoxContainer) {
                        chatBoxContainer.scrollTo(0, chatBoxContainer.scrollHeight);
                    }
                });
            }, (error) => {
                vm.avatar_image_view = vm.old_avatar_image;
                alert('please select or upload the image ');
                vm.add_image_btn = true;
                vm.visibles = true;
                vm.open = false;
            });
            //   }
            // }
            vm.avatar_details = true;
            //   setInterval(() => {
            vm.avatar_details = false;
            // }, 000);

        },

        async submit(e) {
            var vm = this;
            if(vm.text  == ''){
                return alert('Please add text or file')
            }
            if(this.text){
                this.filterWords()
            }
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let formData = new FormData();
            formData.append('user', this.userId);
            formData.append('user_details', vm.user_details);
            formData.append('livestreams_id', vm.livestream.id);
            formData.append('file_type', vm.file_type);
            formData.append('file', vm.file);
            formData.append('message', vm.text);


            if(vm.submit_text_form){
                vm.submit_text_form = false;
                axios.post('/message', formData, config).then((response) => {
                formData = new FormData();
                    vm.text =' ';
                    vm.file_type = '';
                    vm.file = '';
                if (vm.total_chat == 0) {
                    vm.total_chat = 1;
                }
                vm.submit_text_form = true;

                this.getUserLivestrea(this.livestream.id);
                $(".v3-emoji-picker-textarea").text('');
                $(".v3-emoji-picker-textarea").html('');
                    $('.v3-emoji-picker-textarea').val('').change();

                vm.$nextTick(() => {
                    var chatBoxContainer = document.getElementById('chat-box-container')
                    if (chatBoxContainer) {
                        chatBoxContainer.scrollTo(0, chatBoxContainer.scrollHeight);
                    }
                });

            }).catch(error => {

                if (error.response.status === 422) {
                    error.response.data.forEach((value, index) => {
                      if(value.hasOwnProperty('message')){
                            alert(value.message[0]);

                      }
                      if(value.hasOwnProperty('file')){
                        alert(value.file[0]);
                      }
                        vm.file ='';
                        vm.file_type = '';
                        vm.text = ' ';
                        vm.submit_text_form = true;
                        vm.submit_text_form = true;
                    });
                    } else {
                    // Display a generic error message
                    this.$toast.error('An error occurred. Please try again later.')
                    }


            });
            }
        },
        onChangeText(new_text) {
            if(new_text){
             //   this.text += new_text;
            }
        },
        handleSpace(){
            if(this.text){
                this.filterWords();

            }
        },
        onUpdate(e) {
            this.$emit('update:input', '')
        },
        onSelectEmoji(emoji) {
            this.text += emoji.i;

        },
        showEmoji(emoji) {
        },
        setSelectionRange() {
            this.$nextTick(() => {
                this.text = "";
                this.showpicker = true;
                console.log(this.refs.elem.setSelectionRange(2, 2));
            });
        },
        scrollToEnd() {

            this.$nextTick(() => {
                if (this.$refs.modalview) {
                    this.$refs.modalview.scrollTop = this.$refs.modalview.scrollHeight;
                }
            });
        },
        openModal() {
            //
        },
        modelClose() {
            var vm = this;
            vm.add_image_btn = true;
            this.visibles = true;
            this.visibles_avatar = false;
            this.open = true;

            this.$nextTick(() => {
                var chatBoxContainer = document.getElementById('chat-box-container')
                if (chatBoxContainer) {
                    chatBoxContainer.scrollTo(0, chatBoxContainer.scrollHeight);
                }
            });
        },
        selectImage(el) {
            var vm = this;
            vm.avatar_image_view = el;
            vm.avatar_image = el;
            vm.avatar_preview_image = this.avatar_image;
        },

        async getUserLivestrea(id) {
            var vm = this;
            axios.get('/livestream/' + id).then((response) => {
                if (vm.total_chat == 0 || vm.avatar_image == '') {
                    vm.add_image_btn = true;
                }
                $(".v3-emoji-picker-textarea").html('');
                $('.v3-emoji-picker-textarea').val('').change();
            }, (error) => {
            })
        },
        joinchatRoom() {
                var vm = this;
                vm.visibles_avatar = true;
                vm.add_image_btn = false;
                vm.visibles = false;
                vm.openModal();



        },
        uploadAvatarImage(e) {

            var vm = this;
            const file = e.target.files[0];

            vm.old_avatar_image = vm.avatar_image_view;
            vm.avatar_preview_image = URL.createObjectURL(file);
            vm.avatar_image_view = URL.createObjectURL(file);
            vm.avatar_image = e.target.files[0];
        },
        updateAvatarImages() {

            this.visibles_avatar = true;
            this.visibles = false;

            this.update_images = true;
            this.add_image_btn = true;
        },

        filterWords() {
            if (this.containsSpam) {
            const regex = new RegExp(this.wordsToFilter.join('|'), 'gi')
            this.text = this.text.replace(regex, '')

        }

        },
        handleUploadClick(type) {
            this.file_type = type;
            this.add_image_btn = false;
            this.$nextTick(() => {
                this.add_image_btn = true;
            })

            if (type == 'video') {
                this.accept = 'video/mp4,video/x-m4v,video/*';
            }
            if (type == 'image') {
                this.accept = 'image/*';
            }
            if (type == 'pdf') {
                this.accept = '.pdf';
            }
            this.$nextTick(() => {
                this.$refs.fileInput.click();
            });

        },
        onFileInputCancel() {
            console.log('User cancelled file selection');
            // Perform any necessary actions here
        },
        uploadFile(e) {
            this.file = e.target.files[0];
            this.text = e.target.files[0].name;
            this.attach_lists = false;
            this.submit();


        },

    },
    updated() {
        this.scrollToEnd();

    },
    watch: {
        'messages': function (val, oldVal) {
            this.$nextTick(function () {
                //
            });
        },
        'open': function (e) {
            console.log(e)
        },
        'attach_lists':function(val,oldVal){
            if(!oldVal){
                this.file_type='';
            }
        }
    },
    directives: {
        focus: {
            inserted(el) {
                el.focus()
            },
        },
    },
}
</script>
<style>
.v3-input-emoji-picker .v3-input-picker-root .v3-emoji-picker-textarea {
    display: none;
}

#add-avatar figure {
    margin-right: 20px;
    position: relative;
}

.file-btn-lists {
    position: absolute;
    inset: auto 0px 0px auto;
    margin: 0px;
    transform: translate(-12px, -61px);
    right: 42px;
    list-style-type: none;
}

.file-btn-lists li {
    padding: 7px;
    width: 44px;
    background: #cdcecf;
    color: #5c5c5c;
    border-radius: 25px;
    margin-bottom: 10px;
    text-align: center;
}

.file-btn-lists li .fa {
    color: #ffffff;
}

.file-btn-lists li.active {
    opacity: 0.4555;
    z-index: 99999;
}
.toggleBtn {
    color: #000000;
    font-size: 11px;
    margin-left: 22px;
    text-decoration: none;
}
</style>