<template>

<div>
  <p class="error">{{ error }}</p>

  <div v-if="infos !== null && infos !== 1 ">
     <p class="decode-result">
    <b>
    <div v-for="info in infos">
        {{ info.name }}
      </div>
    </b>
    </p>
  </div>

    <center>
    <qrcode-stream @decode="onDecode" @init="onInit" />
    </center>


    <div v-if="infos !== null && infos !== 1 ">
    <div class="modal-footer">
        <a :href="'/certificate/' + result">
        <button type="button" class="btn btn-success">View E-Certificate</button>
        </a>
      </div>
  </div>



</div>


</template>

<script>
import { QrcodeStream } from 'vue-qrcode-reader'

export default {

  components: { QrcodeStream },

  data () {
    return {
      infos : 1, 
      result: '',
      error: ''
    }
  },

  methods: {
    onDecode (result) {
    isURL(result);

    this.result =result;


  function isURL(result) {
  var regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
  if(regex .test(result)) {
    alert('Please scan appropriate QR Code');
  } 

}

axios.get('/scanner/'+ result)
  .then(response => (this.infos = response))
  .catch(function (error) {
    console.log(error);
  });
    },

    async onInit (promise) {
      try {
        await promise
      } catch (error) {
        if (error.name === 'NotAllowedError') {
          this.error = "ERROR: you need to grant camera access permisson"
        } else if (error.name === 'NotFoundError') {
          this.error = "ERROR: no camera on this device"
        } else if (error.name === 'NotSupportedError') {
          this.error = "ERROR: secure context required (HTTPS, localhost)"
        } else if (error.name === 'NotReadableError') {
          this.error = "ERROR: is the camera already in use?"
        } else if (error.name === 'OverconstrainedError') {
          this.error = "ERROR: installed cameras are not suitable"
        } else if (error.name === 'StreamApiNotSupportedError') {
          this.error = "ERROR: Stream API is not supported in this browser"
        }
      }
    }
  }
}
</script>

<style scoped>
.error {
  font-weight: bold;
  color: red;
}
.decode-result{
  font-size:1.5em;
}
</style>