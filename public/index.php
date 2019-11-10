
<audio id="leftAudio" controls>
  <source id="source" src="/location.php?url=https://www.w3schools.com/tags/horse.mp3" type="audio/mpeg">
</audio><br>
<button onclick="document.getElementById('leftAudio').src='https://www.w3schools.com/tags/horse.mp3'">Change source to https://www.w3schools.com/tags/horse.mp3</button>
<button onclick="document.getElementById('leftAudio').src='./location.php?url=https://www.w3schools.com/tags/horse.mp3'">Change source to /location.php?url=https://www.w3schools.com/tags/horse.mp3</button>
<script>
var audioCtx = new (window.AudioContext || window.webkitAudioContext)();
var myAudio = document.getElementById("leftAudio");

// Create a MediaElementAudioSourceNode
// Feed the HTMLMediaElement into it
var source = audioCtx.createMediaElementSource(myAudio);


audioCtx.audioWorklet.addModule('audi-work.js').then(() => {

  // After the resolution of module loading, an AudioWorkletNode can be
  // constructed.
  let gainWorkletNode = new AudioWorkletNode(audioCtx, 'gain-processor');

  // AudioWorkletNode can be interoperable with other native AudioNodes.
  source.connect(gainWorkletNode).connect(audioCtx.destination);
});
</script>
