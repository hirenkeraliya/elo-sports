<template>
    <div>
        <div class="modal" id="add-avatar" v-show="visibles_avatar">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">
                        Upload Avatar Image for Livestreaming
                    </p>
                    <button class="delete" aria-label="close" @click="modelClose">
                    </button>
                </header>
                <section class="modal-card-body">
                    <figure class="mr-6 image is-64x64 is-inline-flex" v-for="(image, key) in dataImages">
                        <a href="javascript:void(0)" @click="selectImage(image.src)">
                            <img :src="image.src" class="s-rounded mr-6" />
                        </a>

                    </figure>
                    <p>
                        Upload Avatar Image for Livestreaming
                    </p>
                    <form @submit.prevent="submitAvatar">
                        <div class="columns">
                            <div class="column">
                                <div class="field">
                                    <label class="label">
                                        Something Else
                                    </label>
                                    <div class="control">
                                        <figure class="mr-6 image is-128x128 is-inline-flex ">

                                            <img :src="avatar_preview_image" v-if="avatar_preview_image" class="mr-6" />
                                            <img src="https://bulma.io/images/placeholders/128x128.png" v-else
                                                class="mr-6" />



                                        </figure>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="field">
                            <label class="label">Avatar File</label>
                            <div class="control">
                                <input  type="file" accept="image/*"  v-on:change="uploadAvatarImage">
                            </div>

                            </div>
                                <div class="field ">
                                    <div class="control">
                                        <button class="button is-success">
                                            Submit
                                        </button>
                                    </div>

                                </div>
                            </div>

                        </div>









                    </form>



                </section>
                <footer class="modal-card-foot">
                    <button class="button is-danger" @click="modelClose">
                                Cancel
                            </button>
                </footer>
            </div>
            <button class="modal-close is-large" aria-label="close"></button>
        </div>
        <button id="myBtn" @click="openChat()" v-if="open" title="Click to start chat">
            Chat
        </button>


        <div class="wrapper">

            <div class="chat-box" id="ChatBox" ref="chat_box" v-if="visibles">


                <div class="chat-head">
                    <button type="button" class="up-avatar btn btn-danger"
                        style="  float: left;margin-top: 13px; margin-left: 15px;border-radius: 22px;"
                        @click="updateAvatarImages()" v-show="avatar_image_view">Edit Avatar</button>
                        <button type="button" class="up-avatar btn btn-danger"  v-show="!avatar_image_view"  @click="joinchatRoom()" >Browse Aavatar</button>
                    <p>{{ livestream.name }}</p>
                    <button id="close-chat" @click="closeChat()"> &#9587;</button>
                </div>

                <ul class="chat-body messages" id="message-body-box" ref="modalview">

                    <li class="card-body msg_card_body" v-for="(message, num) in messages">
                        <div class="d-flex justify-content-start mb-2" style="position:relative;"
                            v-if="message.user.id != user_details.id" :ref="num === messages.length ? 'last' : undefined">

                            <div class="img_cont_msg">

                                <!-- <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg"> -->
                                <img v-if="message.avatars.length > 0" :src="message.avatars[0].avatar_image"
                                    class="rounded-circle user_img_msg" />
                                <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                    class="rounded-circle user_img_msg" v-else />

                            </div>

                            <div class="msg_cotainer">

                                <p>
                                    <span v-if="!message.file_type"  >
                                        {{ message.message.slice(0, 100) }}
                                        <i v-if="message.isOpen">
                                            {{ message.message.slice(100) }}

                                        </i>
                                        <a v-if="message.message.length > 100" class="toggleBtn"  @click="toggleItem(num)" href="javascript:void(0)">Read More ...</a>


                                    </span>
                                    <span v-if="message.file_type">
                                        Download {{ message.file_type }}
                                    </span>
                                    <a :href="message.link + '/' + message.file" class="download-btn" title="Download file"
                                        target="_blank" v-if="message.file_type">
                                        <i class="fa fa-arrow-down"></i>
                                    </a>
                                </p>



                            </div>
                            <div class="msg_time">
                                {{ message.user.username }}
                                {{ message.createAt }}
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mb-2" v-else
                            :ref="num === messages.length ? 'last' : undefined">
                            <!-- <a :href="message.link + '/' + message.file" class="download-btn" title="Download file"
                                       >
                                        <i class="fa fa-trash"></i>
                                    </a> -->
                            <div class="msg_cotainer_send">

                                <p>
                                    <span v-if="!message.file_type"  >
                                        {{ message.message.slice(0, 100) }}
                                        <i v-if="message.isOpen">
                                            {{ message.message.slice(100) }}

                                        </i>
                                        <a v-if="message.message.length > 100" class="toggleBtn"  @click="toggleItem(num)" href="javascript:void(0)">Read More ...</a>


                                    </span>
                                    <span v-if="message.file_type">
                                        Download {{ message.file_type }}
                                    </span>


                                    <a :href="message.link + '/' + message.file" class="download-btn" title="Download file"
                                        target="_blank" v-if="message.file_type">
                                        <i class="fa fa-arrow-down"></i>
                                    </a>
                                </p>

                                <div class="msg_time_send"> {{ message.createAt }}</div>
                            </div>
                            <div class="img_cont_msg">

                                <img :src="avatar_image_view" class="rounded-circle user_img_msg" v-if="avatar_image_view">

                                <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                    class="rounded-circle user_img_msg" v-else />

                            </div>
                        </div>

                    </li>
                </ul>
                <!-- <div > -->
                <div class="chat-text" id="chat-btm" ref="chat-btm">
                    <!-- <form ref="anyName" @submit.prevent="submit"> -->
                    <!-- <At :user_lists="userlist"> -->
                        <textarea v-model="text" ref="chatInput" v-if="add_image_btn" @keydown.enter.prevent.stop="submit(e)"  @keydown.space="handleSpace"></textarea>
                    <Picker  :native="true" :display-recent="false" picker-type="textarea" ref="emojis"
                        @update:text="onChangeText" v-if="add_image_btn" @keydown.enter.prevent="submit(e)"
                        @select="onSelectEmoji"  @keydown.space="handleSpace" />

                    <button type="button" class="send-btn" @click="submit()" v-show="add_image_btn">
                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="attach-btn" @click="attach_lists = !attach_lists" v-show="add_image_btn">
                        <i class="fa fa-file" aria-hidden="true"></i>
                    </button>
                    <input type="file" ref="fileInput" :accept="this.accept" style="display: none" @change="uploadFile"
                        >
                    <transition name="fade">
                        <ul class="file-btn-lists" v-show="attach_lists">

                            <li title="Upload image" :class="[(this.file_type == 'image') ? 'active' : '']">
                                <a @click="handleUploadClick('image')"  v-show="add_image_btn">
                                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li title="Upload Video" :class="[(this.file_type == 'video') ? 'active' : '']">
                                <a @click="handleUploadClick('video')"  v-show="add_image_btn">
                                    <i class="fa fa-file-video-o" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li title="Upload Pdf" :class="[(this.file_type == 'pdf') ? 'active' : '']">
                                <a @click="handleUploadClick('pdf')"  v-show="add_image_btn">
                                    <i class="fa fa-file-pdf-o " aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </transition>
                    <!-- </form> -->
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
    updated: function () {
        console.log('update check when');
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
            console.log(this.$refs.emoji);

        });

        axios.get('/filters/').then((response) => {
            console.log('filters-word',response.data.data)
            this.wordsToFilter = response.data.data;
        });
        var vm = this;

        this.getChatMessage()

        // to connect the public channel
        window.Echo.channel('chat-room').listen('.new-message', (e) => {

            if (vm.livestream.id === e.chat.livestreams_id) {
                if(!this.text){
                    console.log('lkjd');
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
             console.log( vm.livestream);
            vm.livestream = e.livestream;
            console.log( vm.livestream);
            if(e.livestream.status == 'stopped'){
                document.getElementById('btn-bet').style.display = 'none';
                document.getElementById('data-table').style.display = 'none';

                this.visibles = false;
                this.open = false;
            }
        });
        window.Echo.channel('twitch-room').listen('.twitch-room', (e) => {
            console.log(e)
            vm.livestream = ' ';
             console.log( vm.livestream);
            vm.livestream = e.livestream;
            console.log( vm.livestream);
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
                console.log('word',spamWords);
                vm.foundWord = spamWords.find(word => this.text.toLowerCase().includes(word.toLowerCase()))
                console.log('word111',vm.foundWord);
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
         console.log(this.messages[index].isOpen)
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
            }, (error) => {
                console.log(vm.old_avatar_image);
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
            console.log(vm.text);
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

            }).catch(error => {

                if (error.response.status === 422) {
                    console.log(error.response.data);
                    error.response.data.forEach((value, index) => {
                      console.log(value)
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
            console.log('-------1', new_text)
            if(new_text){
             //   this.text += new_text;
            }
        },
        handleSpace(){
            if(this.text){
                console.log(this.text,1)
                this.filterWords();

            }
        },
        onUpdate(e) {
            this.$emit('update:input', '')
        },
        onSelectEmoji(emoji) {
            console.log(emoji.i);
            this.text += emoji.i;

        },
        showEmoji(emoji) {
            console.log(`emoji ${emoji.i} selected, check console for details`);
            console.log(emoji);
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

                this.$refs.modalview.scrollTop = this.$refs.modalview.scrollHeight;
            });
        },
        openModal() {
            document.getElementById("add-avatar").classList.add("is-active");
        },
        modelClose() {
            var vm = this;
            vm.add_image_btn = true;

            document.getElementById("add-avatar").classList.remove("is-clipped");
            document.getElementById("add-avatar").classList.remove("is-active");
            this.visibles = false;
            this.open = true;
        },
        selectImage(el) {
            var vm = this;
            vm.avatar_image_view = el;
            vm.avatar_image = el;
            vm.avatar_preview_image = this.avatar_image;
            console.log(this.avatar_image);

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
            console.log(vm.old_avatar_image);

        },
        updateAvatarImages() {

            this.visibles_avatar = true;
            this.visibles = false;
            document.getElementById("add-avatar").classList.add("is-active");

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
            console.log(e)
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
                console.log(this.refs.emojis)
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
                console.log(el);
                el.focus()
            },
        },
    },
}
</script>
<style>
.chat-box textarea {
    padding: 3px 5px 2px 9px !important;
    resize: vertical;
    width: 284px !important;
    min-height: 44px !important;
    resize: vertical !important;
    border: 0px !important;
    resize: none !important;
    margin-left: -25px;

    overflow-y: hidden;
}
.v3-input-emoji-picker .v3-input-picker-root .v3-input-picker-wrap .v3-input-picker-icon img {
    display: block;
    width: 1em;
    height: 1em;
    margin-left: 6px;
    margin-top: 4px;
}
.v3-input-emoji-picker * {
    box-sizing: border-box;
    margin-top: -12px;
}
.v3-input-emoji-picker .v3-input-picker-root .v3-emoji-picker-textarea {
    /* min-height: 44px;
    resize: vertical;
    border: 0px;
    resize: none;
    width: 309px;
    margin-left: -6px; */
    min-height: 44px;
    resize: vertical;
    border: 0px;
    resize: none;
    width: 274px;
    margin-left: -25px;
    display: none;
}

.v3-input-emoji-picker .v3-input-picker-root .v3-emoji-picker-textarea:focus,
.chat-box textarea:focus {
    outline: none !important;
    border: 0px;
    box-shadow: 0 0 10px #719ECE;
}

.v3-input-emoji-picker .v3-input-picker-root .v3-emoji-picker-textarea+.v3-input-picker-wrap .v3-input-picker-icon {
    display: block;
    position: absolute;
    left: 5px;
    top: 47%;
    transform: translateY(-50%);
    font-size: 24px;
    border: none;
    background: none;
    padding: 0 5px;
    width: 34px;
}

.v3-input-emoji-picker .v3-input-picker-root .v3-emoji-picker-textarea+.v3-input-picker-wrap .v3-input-picker-icon {
    display: block;
    position: absolute;
    left: 0px;
    top: 47%;
    transform: translateY(-50%);
    font-size: 24px;
    border: none;
    background: none;
    padding: 0 5px;
    width: 49px;
    height: 50px;
    background-color: #d2d1d1;
    color: #ef921a;
}

.v3-input-emoji-picker .v3-input-picker-root .v3-input-picker-wrap .v3-input-picker-icon img {
    display: block;
    width: 1em;
    height: 1em;
    margin-left: 5px;
}

#add-avatar figure {
    margin-right: 20px;
    position: relative;
}

.v3-emoji-picker .v3-color-theme-light {
    position: absolute;
    inset: auto 0px 0px auto;
    margin: 0px;
    transform: translate(-5px, -47px);
    z-index: 1111111;
}

/* #add-avatar input {
    position: absolute;
    top: 2px;
    right: 7px;
  } */
</style>
<style  lang="css" scoped>
body {
    background-color: #74EBD5;
    background-image: linear-gradient(90deg, #74EBD5 0%, #9FACE6 100%);

    min-height: 100vh;
}

::-webkit-scrollbar {
    width: 5px;
}

::-webkit-scrollbar-track {
    width: 5px;
    background: #f5f5f5;
}

::-webkit-scrollbar-thumb {
    width: 1em;
    background-color: #ddd;
    outline: 1px solid slategrey;
    border-radius: 1rem;
}

.text-small {
    font-size: 0.9rem;
}

/* .messages-box,
.chat-box {
  height: 510px;
  overflow-y: scroll;
} */

.rounded-lg {
    border-radius: 0.5rem;
}

.send-btn {
    position: absolute;
    right: 0px;
    background-color: #d2d1d1;
    display: block;
    position: absolute;
    right: 0px;
    top: 47%;
    transform: translateY(-50%);
    font-size: 24px;
    border: none;
    padding: 0 5px;
    width: 40px;
    height: 45px;
    background-color: #d2d1d1;
    color: #ef921a;
}

.attach-btn {
    display: block;
    position: absolute;
    right: 36px;
    top: 47%;
    transform: translateY(-50%);
    font-size: 24px;
    border: none;
    background: none;
    padding: 0 5px;
    width: 32px;
    height: 45px;
    background-color: #d2d1d1;
    color: #ef921a
}

.send-btn .fa,
.attach-btn .fa {
    color: #ffffff;
}

input::placeholder {
    font-size: 0.9rem;
    color: #999;
}

.chat-box {
    height: 510px;
    width: 400px;
    /* margin-bottom: 5em; */
    /* float: right; */
    position: fixed;
    bottom: -37px;
    right: 50px;
    text-decoration: none;
    text-align: center;
    line-height: 20px;
    color: white;
    border-radius: 0px;

    z-index: 999999;
    background: white;
    scroll-behavior: smooth;

}

/* .chat-box .v3-input-emoji-picker .v3-input-picker-root {
    position: none;
} */

.message-lists {
    height: 250px;
}

.message-form {

    width: 400px;
    margin-bottom: 2em;
    /* float: right; */
    position: fixed;
    bottom: -28px;
    right: 50px;
    text-decoration: none;
    text-align: center;
    line-height: 20px;
    color: white;
    border-radius: 0px;
}

small {
    color: #ccc;
    font-size: 0.65em;
}



/* .chat-box{
	position: absolute;
	right: 20px;
	bottom: 0px;
	background: white;
	width: 300px;
	border-radius: 5px 5px 0px 0px;
} */
.chat-head {
    width: inherit;
    height: 64px;
    background: #2c3e50;
    border-radius: 5px 5px 0px 0px;
    position: relative;
}

.chat-head p {
    text-transform: capitalize;
    color: white;
    padding: 24px 77px 0px 8px;
    font-size: 16px;
    margin-left: 58px;
    display: block;

}

.chat-head img {
    cursor: pointer;
    float: right;
    width: 25px;
    margin: 10px;
}

.chat-body {
    height: 355px;
    overflow: scroll;
    padding: 0px;
    margin: 0px;
    ;
}

.chat-text {
    position: fixed;
    bottom: 0px;
     height: 45px !important;
    width: inherit;
    color: #13181d;
    border-top: 1px solid;
}





.msg-send {
    background: #2ecc71;
}

.msg-receive {
    background: #3498db;
}

.msg-send,
.msg-receive {
    width: 200px;
    height: 35px;
    padding: 5px 5px 5px 10px;
    margin: 10px auto;
    border-radius: 3px;
    line-height: 30px;
    position: relative;
    color: white;
}

.msg-receive:before {
    content: '';
    width: 0px;
    height: 0px;
    position: absolute;
    border: 15px solid;
    border-color: transparent #3498db transparent transparent;
    left: -29px;
    top: 7px;
}

.msg-send:after {
    content: '';
    width: 0px;
    height: 0px;
    position: absolute;
    border: 15px solid;
    border-color: transparent transparent transparent #2ecc71;
    right: -29px;
    top: 7px;
}

.msg-receive:hover,
.msg-send:hover {
    opacity: .9;
}

.img_cont_msg img {
    height: 40px;
    width: 40px;
}

.msg_cotainer {
    margin-top: auto;
    margin-bottom: auto;
    margin-left: 10px;
    border-radius: 7px;
    background-color: #82ccdd;
    padding: 10px;
    position: relative;
    min-width: 200px;
    max-width: 257px;
    text-align: left;
    line-height: 17px;
}

.msg_time {
    position: absolute;
    left: 63px;
    bottom: -18px;
    color: rgb(20 18 18 / 50%);
    font-size: 10px;
    /* top: 47px; */
    font-size: 10px;
}

.msg_cotainer_send {
    margin-top: auto;
    margin-bottom: auto;
    margin-right: 10px;
    border-radius: 7px;
    background-color: #78e08f;
    padding: 10px;
    position: relative;
    min-width: 200px;
    max-width: 257px;
    text-align: left;
    line-height: 17px;
}

.msg_cotainer_send p,
.msg_cotainer p {
    white-space: pre-wrap;
    word-wrap: break-word;
}

.msg_time_send {
    position: absolute;
    right: 0;
    bottom: -15px;
    color: rgb(20 18 18 / 50%);
    font-size: 10px;
}

#close-chat {
     /* position: fixed; */
    /* top: 0px; */
    /* right: 52px; */
    z-index: 99;
    /* bottom: 116px; */
    font-size: 21px;
    border: none;
    outline: none;
    background-color: transparent;
    color: white;
    cursor: pointer;
    padding: 15px;
    border-radius: 4px;
    float: right;
    margin-top: -40px;
}

.file-btn-lists {
    position: absolute;
    inset: auto 0px 0px auto;
    margin: 0px;
    transform: translate(-12px, -61px)
}

.file-btn-lists li {
    padding: 11px;
    width: 44px;
    background: #dc3545;
    border-radius: 25px;
    margin-bottom: 10px
}

.file-btn-lists li:nth-child(2) {
    background: #d111c7;
}

.file-btn-lists li:nth-child(3) {
    background: #0569ec;
}

.file-btn-lists li .fa {
    color: #ffffff;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}

.download-btn {
    position: absolute;
    right: 14px;
    top: 9px;
    color: #fff;
    width: 16px;
}
.file-btn-lists li.active {
    opacity: 0.4555;
    z-index: 99999;
}
.card-body {
    padding: 0.4rem 1rem !important;
}
.toggleBtn {
    color: #000000;
    font-size: 11px;
    margin-left: 22px;
    text-decoration: none;
}
.up-avatar{
    float: left;
    margin-top: 13px;
     margin-left: 15px;
     border-radius: 22px;
     display: inline-block;
}
</style>

<!-- IP : 139.59.72.217
Usrename : root
Password : @3s^2jO5MyIu -->
//DB_USERNAME=axay
//DB_PASSWORD=Vj1234?!!!
//elo_sports
<!-- development -->
<!-- PL7#11n47ZS52d#Zat
root@159.65.150.15 -->

<!-- ssl_certificate /etc/letsencrypt/live/uat.elo-esports.com/fullchain.pem;
ssl_certificate_key /etc/letsencrypt/live/uat.elo-esports.com/privkey.pem; -->
 <!-- development
ssl_certificate /etc/letsencrypt/live/development.elo-esports.com/fullchain.pem; # managed by Certbot
ssl_certificate_key /etc/letsencrypt/live/development.elo-esports.com/privkey.pem; # managed by Certbot -->