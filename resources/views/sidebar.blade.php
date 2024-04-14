<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
  margin: 0;
  font-family: "Montserrat", sans-serif;
}

.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #3d464d;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}

.sidebar a.active {
  background-color: #04AA6D;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}
</style>
</head>
<body>

<div class="sidebar">
  <a class="active" href="#home">Roles</a>
  <a href="#news">Scores</a>
  <a href="#contact">Privacy Policy</a>
  <a href="#about">Users</a>
  <a href="#about">Clients</a>
  <a href="#about">Self Assign Audits</a>
  <a href="#about">Dashboard</a>
  <a href="#about">Training</a>
  <a href="#about">QM Sheet</a>
  <a href="#about">Campaign</a>
  <a href="#about">Touchpoint</a>
  <a href="#about">Beat Plan</a>
  <a href="#about">Completed Audits</a>
  <a href="#about">Action Planing</a>
  <a href="#about">Client Rebuttals</a>
  <a href="#about">QC Rebuttal</a>
  <a href="#about">Payment Management</a>
  <a href="#about">Edit Transaction</a>
  <a href="#about">Reports</a>
</div>

<div class="content">
  <h2>Responsive Sidebar Example</h2>
  <p>This example use media queries to transform the sidebar to a top navigation bar when the screen size is 700px or less.</p>
  <p>We have also added a media query for screens that are 400px or less, which will vertically stack and center the navigation links.</p>
  <h3>Resize the browser window to see the effect.</h3>
</div>

</body>
</html>
