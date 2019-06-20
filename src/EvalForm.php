<?php

function get_options($name) {
  return 'You are currently grading: '.$name.
  '<div id="role">
    <label style="margin-left: 10em";><h5>Role</h5></label><br>
    <label>Worst</label>
    <input type="radio" class="radio" name="role'.$name.'" id="role0'.$name.'" value="0"> Rarely completes assigned work<br>
    <input type="radio" class="radio" name="role'.$name.'" id="role1'.$name.'" value="1"> Occasionally completes work<br>
    <input type="radio" class="radio" name="role'.$name.'" id="role2'.$name.'" value="2"> Mostly completes assigned work<br>
    <input type="radio" class="radio" name="role'.$name.'" id="role3'.$name.'" value="3"> Always completes assigned work
    <label>Best</label>
  </div><br><br><br>
  <div id="Leadership">
    <label style="margin-left: 10em";><h5>Leadership</h5></label><br>
    <label>Worst</label>
        <input type="radio" class="radio" name="leadership'.$name.'" id="leadership0'.$name.'" value="0"> Rarely takes leadership role; Does not collaborate<br>
        <input type="radio" class="radio" name="leadership'.$name.'" id="leadership1'.$name.'" value="1"> Occasionally shows leadership; Mostly collaborates <br>
        <input type="radio" class="radio" name="leadership'.$name.'" id="leadership2'.$name.'" value="2"> Shows an ability to lead when necessary; Willing to assist teammates<br>
        <input type="radio" class="radio" name="leadership'.$name.'" id="leadership3'.$name.'" value="3"> Takes leadership role; Is a good collaborator
    <label>Best</label>
  </div><br><br><br>
  <div id="Participation">
    <label style="margin-left: 10em";><h5>Participation</h5></label><br>
    <label>Worst</label>
        <input type="radio" class="radio" name="participation'.$name.'" id="participation0'.$name.'" value="0"> Rarely participates in meeting and does not share ideas<br>
        <input type="radio" class="radio" name="participation'.$name.'"  id="participation1'.$name.'" value="1"> Offers unclear or unhelpful ideas in meetings<br>
        <input type="radio" class="radio" name="participation'.$name.'"  id="participation2'.$name.'" value="2"> Attends and particpates in most meetings; Offer useful ideas in meetings<br>
        <input type="radio" class="radio" name="participation'.$name.'"  id="participation3'.$name.'" value="3"> Attends and participates in all meetings; Clearly expresses well developed ideas
    <label>Best</label>
  </div><br><br><br>
  <div id="Professionalism">
  <label style="margin-left: 10em";><h5>Professionalism</h5></label><br>
    <label>Worst</label>
        <input type="radio" class="radio" name="prof'.$name.'" id="professionalism0'.$name.'" value="0"> Often discourteous and/or openly critical of teammates <br>
        <input type="radio" class="radio" name="prof'.$name.'" id="professionalism1'.$name.'" value="1"> Usually appreciates teammates\' perspective, but often unwilling to consider them<br>
        <input type="radio" class="radio" name="prof'.$name.'" id="professionalism2'.$name.'" value="2"> Values teammates\' perspectives and often willing to consider them<br>
        <input type="radio" class="radio" name="prof'.$name.'" id="professionalism3'.$name.'" value="3"> Always courteous to teammates
    <label>Best</label>
  </div><br><br><br>
  <div id="Quality">
    <label style="margin-left: 10em";><h5>Quality</h5></label><br>
    <label>Worst</label>
        <input type="radio" class="radio" name="quality'.$name.'" id="quality0'.$name.'" value="0"> Rarely commits to shared documents<br>
        <input type="radio" class="radio" name="quality'.$name.'" id="quality1'.$name.'" value="1"> Other sometimes needed to revise, debug, or fix their work<br>
        <input type="radio" class="radio" name="quality'.$name.'" id="quality2'.$name.'" value="2"> Often commits to shared documents<br>
        <input type="radio" class="radio" name="quality'.$name.'" id="quality3'.$name.'" value="3"> Frequently commits to shared documents
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

?>
