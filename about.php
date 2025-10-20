<?php 

session_start();

include_once 'env_loader.php';
include_once 'conn.php';


if (!$conn) {#check the sytanx for this
          die("<p> We are experiencing technical difficulties, please try again later</p>");
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'header.inc'; ?>
  <style>
  body {
    background-color: hotpink !important;
  }
</style>
</head>

<body>
  <!-- nav bar -->
  <header>
    
     <!-- The navigation bar and logo -->
    <?php include 'navbar.inc'; ?>

  </header>


  <!-- Decorative swords margins-->
  <div class="swords" aria-hidden="true">
    <!-- Main page content -->
    <main class="page">

      <!-- Page heading -->
      <section id="headings">
        <h2>About Us</h2>
        <h3>Meet the Team</h3>
      </section>

      <!-- Team profiles grid -->
      <section id="profiles">
        <ul class="profile_grid">
          <li id="Ari" class="profile">
            <h3 class="sub_head">Ari Stein</h3> <h4 class = "sub_head3">105764217</h4>
            <img src="images/Ari_profile.png" alt="Ari Stein">
            <h4 class = "sub_head3">Jobs Page, Validating Code</h4>
            <p><strong>Quote:</strong>"tengo un sueño" <br> <strong>Translation:</strong> "I have a dream" Martin Luther King Jr.</p>
          </li>

          <li id="Jack" class="profile">
            <h3 class="sub_head">Jack Rosewarne</h3> <h4 class = "sub_head3">103968952</h4>
            <img src="images/Jack_profile.jpeg" alt="Jack Rosewarne">
            <h4 class = "sub_head3"> About Page, Jira</h4>
            <p><strong>Quote:</strong> "Sie verpassen 100 Prozent der Schüsse, die Sie nie abgeben."  <br> <strong>Translation:</strong>"You miss 100 percent of the shots you never take." Wayne Gretzky </p>
          </li>

          <li id="Silang" class="profile">
            <h3 class="sub_head">Silang Song</h3> <h4 class = "sub_head3">104548960</h4>
            <img src="images/Silang_profile.JPG" alt="Silang Song">
            <h4 class = "sub_head3">Apply Page, Organising Meetings</h4>
            <p><strong>Quote:</strong>"识时务者为俊杰" <br> <strong>Translation:</strong>"A wise man adapts to changing circumstances" Kong Ming </p>
          </li>

          <li id="David" class="profile">
            <h3 class="sub_head">David Wei</h3> <h4 class = "sub_head3">106148333</h4>
            <img src="images/David_profile.jpg" alt="David Wei">
             <h4 class = "sub_head3">Home Page, Submitting</h4>
            <p><strong>Quote:</strong>"Pienso, luego existo"<br><strong>Translation:</strong>"I think, therefore I am." René Descartes </p>
          </li>
        </ul>
      </section>

            <!-- Team contribution  SQL table -->
      <section class="table_wrap">
  <h3>Team Member Contributions</h3>

  <?php
  
  $stmt = $conn->prepare('SELECT * FROM `about`'); /* preparing statments to prevent SQL injections or malicious data inputs */
  /*$stmt->bind_param('s', $member_name); --why does this make the table disappear even when I put in parameters*/
  $stmt->execute();
  $result = $stmt->get_result(); /* code made with guidance from Mysqli SELECT query with prepared statements. 
                                  (2025). Treating PHP Delusions. https://phpdelusions.net/mysqli_examples/prepared_select?utm_source=chatgpt.com */


      if (mysqli_num_rows($result) > 0) {
          echo "<table class='contributions' aria-label = 'Member contributions for project 1 and project 2'>"; #ARIA accessibility 
          echo "<thead>";
          echo "<tr><th>Name</th><th>Project 1 Contributions</th><th>Project 2 Contributions</th></tr>";
          echo "</thead><tbody>";

          while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td class='member_names'>" . htmlspecialchars($row['member_name']) . "</td>";
              echo "<td class='project_1'>" . nl2br(htmlspecialchars($row['project_1_contributions'])) . "</td>";
              echo "<td class='project_2'>" . nl2br(htmlspecialchars($row['project_2_contributions'])) . "</td>"; # nl2br = creates display separation 
              echo "</tr>";
          }

          echo "</tbody></table>";
        } else {
            echo "<p>Database query could not be prepared.</p>";
        }

        mysqli_close($conn);
        ?>
      </section>

      <br>
      <br>

      <!-- Team photo card -->
      <section class="figure_card">
        <h2 class="sub_head2">Our Team Photo</h2>
        <figure>
          <img src="images/Group_photo_cropped.jpg" alt="The team at work">
          <figcaption>The team at work</figcaption>
        </figure>
      </section>

      <!-- Team info table -->
      <section class="table_wrap">
        <h3>More about the Team</h3>

        <table class="team_table">
          <thead>
            <tr>
              <th class="sub_head">Name</th>
              <th class="sub_head">Role</th>
              <th class="sub_head">Hobbies</th>
              <th class="sub_head">Favourite Game</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Ari Stein</td>
              <td>Project Manager</td>
              <td>Cricket, Gaming, Reading</td>
              <td>Tomb Raider</td>
            </tr>
            <tr>
              <td>Jack Rosewarne</td>
              <td>Developer</td>
              <td>Gym, Basketball, Gaming</td>
              <td>Silksong</td>
            </tr>
            <tr>
              <td>Silang Song</td>
              <td>Developer</td>
              <td>Badminton, RPG, Sleeping</td>
              <td>Maplestory</td>
            </tr>
            <tr>
              <td>David Wei</td>
              <td>Developer</td>
              <td>Rock Climbing, Reading, Baking</td>
              <td>Silent Hill 2</td>
            </tr>
          </tbody>
        </table>
      </section>

    </main>
  </div>

   <!-- link to application page -->
    <div class="application">
    <p><a href="apply.php">Apply Here</a></p>
    </div>

  <!-- Footer -->
    <?php include 'footer.inc'; ?>

</body>


</html>
