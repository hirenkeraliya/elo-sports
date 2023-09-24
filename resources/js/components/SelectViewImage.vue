<template>
    <div>
      <vue-select-image :dataImages="dataImages" @onselectimage="onSelectImage">
      </vue-select-image>
    </div>
  </template>
  
  <script>
  
  import VueSelectImage from "vue-select-image";
  import "vue-select-image/dist/vue-select-image.css";
  
  export default {
    name: "SelectImage",
    data() {
      return {
        dataImages: [
          {
            id: "1",
            src: "https://unsplash.it/250?random=1",
            alt: "Alt Image 1",
          },
          {
            id: "2",
            src: "https://unsplash.it/250?random=2",
            alt: "Alt Image 2",
          },
          {
            id: "3",
            src: "https://unsplash.it/250?random=3",
            alt: "Alt Image 3",
          },
        ],
      };
    },
    methods: {
      onSelectImage(img) {
        alert(`Selected image: ${img.alt}`);
      },
    },
    components: {
      VueSelectImage,
    },
  };
  </script>
  