<html>
<body>

<h1>Resources</h1>

<p>Click the behaviour to view details.</p>

<button onclick="Disruptive()">Disruptive</button>
<button onclick="Inappropriate()">Inappropriate</button>
<button onclick="Under()">Underperformance</button>
<button onclick="Violent()">Violent</button>
<button onclick="Withdrawn()">Withdrawn</button>

<p id="demo"></p>

<script>
function Inappropriate() {
  document.getElementById("demo").innerHTML = "Teach Coping Skills";
}
function Withdrawn() {
  document.getElementById("demo").innerHTML = "Withdrawn Behaviours - Tendency to avoid either unfamiliar persons, locations, or situations. Withdrawal behavior is characterized by the tendency to avoid the unfamiliar, either people, places, or situations. Help";
}
function Under() {
  document.getElementById("demo").innerHTML = "Underperformance";
}
function Violent() {
  document.getElementById("demo").innerHTML = "Violent Behaviours";
}
function Disruptive() {
  document.getElementById("demo").innerHTML = "Inappropriate";
}

</script>

</body>
</html>
