<?php

function get_options($name) {
  return 'You are currently grading: '.$name.
  '<div id="role">
    <label style="margin-left: 10em";><h5>Role</h5></label><br>
    <label>Worst</label>
      <form style="margin-left: 2.5em";>
        <input type="radio" class="radio" name="role" id="role0" value="0points"> Rarely completes assigned work<br>
        <input type="radio" class="radio" name="role" id="role1" value="1point"> Occasionally completes work<br>
        <input type="radio" class="radio" name="role" id="role2" value="2point"> Mostly completes assigned work<br>
        <input type="radio" class="radio" name="role" id="role3" value="3point"> Always completes assigned work
      </form>
    <label>Best</label>
  </div><br><br><br>
  <div id="Leadership">
    <label style="margin-left: 10em";><h5>Leadership</h5></label><br>
    <label>Worst</label>
      <form style="margin-left: 2.5em";>
        <input type="radio" class="radio" name="leadership" id="leadership0" value="0points"> Rarely takes leadership role; Does not collaborate<br>
        <input type="radio" class="radio" name="leadership" id="leadership1" value="1point"> Occasionally shows leadership; Mostly collaborates <br>
        <input type="radio" class="radio" name="leadership" id="leadership2" value="2point"> Shows an ability to lead when necessary; Willing to assist teammates<br>
        <input type="radio" class="radio" name="leadership" id="leadership3" value="3point"> Takes leadership role; Is a good collaborator
      </form>
    <label>Best</label>
  </div><br><br><br>
  <div id="Participation">
    <label style="margin-left: 10em";><h5>Participation</h5></label><br>
    <label>Worst</label>
      <form style="margin-left: 2.5em";>
        <input type="radio" class="radio" name="participation" id="participation0" value="0points"> Rarely participates in meeting and does not share ideas<br>
        <input type="radio" class="radio" name="participation"  id="participation1" value="1point"> Offers unclear or unhelpful ideas in meetings<br>
        <input type="radio" class="radio" name="participation"  id="participation2" value="2point"> Attends and particpates in most meetings; Offer useful ideas in meetings<br>
        <input type="radio" class="radio" name="participation"  id="participation3" value="3point"> Attends and participates in all meetings; Clearly expresses well developed ideas
      </form>
    <label>Best</label>
  </div><br><br><br>
  <div id="Professionalism">
  <label style="margin-left: 10em";><h5>Professionalism</h5></label><br>
    <label>Worst</label>
      <form style="margin-left: 2.5em";>
        <input type="radio" class="radio" name="prof" id="professionalism0" value="0points"> Often discourteous and/or openly critical of teammates <br>
        <input type="radio" class="radio" name="prof" id="professionalism1" value="1point"> Usually appreciates teammates\' perspective, but often unwilling to consider them<br>
        <input type="radio" class="radio" name="prof" id="professionalism2" value="2point"> Values teammates\' perspectives and often willing to consider them<br>
        <input type="radio" class="radio" name="prof" id="professionalism3" value="3point"> Always courteous to teammates
      </form>
    <label>Best</label>
  </div><br><br><br>
  <div id="Quality">
    <label style="margin-left: 10em";><h5>Quality</h5></label><br>
    <label>Worst</label>
      <form style="margin-left: 2.5em";>
        <input type="radio" class="radio" name="quality" id="quality0" value="0points"> Rarely commits to shared documents<br>
        <input type="radio" class="radio" name="quality" id="quality1" value="1point"> Other sometimes needed to revise, debug, or fix their work<br>
        <input type="radio" class="radio" name="quality" id="quality2" value="2point"> Often commits to shared documents<br>
        <input type="radio" class="radio" name="quality" id="quality3" value="3point"> Frequently commits to shared documents
      </form>
    <label>Best</label>
  </div><br><br>';
}

function get_form($names) {
  $top = file_get_contents("top.html");
  $bottom = file_get_contents("bottom.html");

  $form = "";
  foreach ($names as $name) {
    $form = $form.get_options($name);
  }

  return $top.$form.$bottom;
}

echo get_form(array("Frank", "John", "Someone", "Else"));

?>
