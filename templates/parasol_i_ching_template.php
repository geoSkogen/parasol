<?php

class Parasol_I_Ching_Template {

  public function __construct() {
    error_log('build template');
  }

  public function app_html() {

    //error_log('this is app html!!!');
    ob_start();
    ?>

    <div id="relshell">
    <!-- navigation icon -->
    <div id="nav-hex">
      <div class="nav-hex-line"></div>
      <div class="nav-hex-line"></div>
      <div class="nav-hex-line"></div>
      <div class="nav-hex-line"></div>
      <div class="nav-hex-line"></div>
      <div class="nav-hex-line"></div>
    </div>

    <!-- navigation menu -->
    <div id="nav-modal-shell">
      <div id="nav-modal">
        <div id="close-nav-modal" class="close-modal">&laquo;</div>
        <ul id="nav-list">
          <li class="nav-option">
            <a class="nav-anchor"id="build" data-display="block,none" data-opacity="10,3.3" data-decor="underline,none" href="build/">build</a>
          </li>
          <li class="nav-option">
            <a class="nav-anchor" id="explore" data-display="block,none" data-opacity="10,3.3" data-decor="underline,none" href="#">explore</a>
            <div id="subnav-modal">
              <ul id="explore-list" class="nav-sublist">
                <li class="nav-suboption">
                  <a class="subnav-anchor explore" href="trigrams/">八卦<br/>trigrams</a>
                </li>
                <li class="nav-suboption">
                  <a class="subnav-anchor explore" href="hexagrams/">卦<br/>hexagrams</a>
                </li>
                <li class="nav-suboption">
                  <a class="subnav-anchor explore" href="i-ching/">易經<br/>the book</a>
                </li>
                <li class="nav-suboption">
                  <a class="subnav-anchor explore" href="ex-machina/">貞<br/>ex machina</a>
              </ul>
            </div>
          </li>
          <li class="nav-option">
            <a class="nav-anchor" id="profile" data-display="block,none" data-opacity="10,3.3" data-decor="underline,none" href="#">profile</a>
            <div id="subnav-modal">
              <ul id="profile-list" class="nav-sublist">
                <li class="nav-suboption">
                  <a class="subnav-anchor profile" href="/book-of-changes/profile/archives/">archives</a>
                </li>
                <li class="nav-suboption">
                  <a class="subnav-anchor profile" href="/book-of-changes/profile/users/">message</a>
                </li>
                <li class="nav-suboption">
                  <a class="subnav-anchor profile" href="/book-of-changes/profile/">settings</a>
                </li>
                <li class="nav-suboption">
                  <a class="subnav-anchor profile" href="#">logout</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div><!-- nav modal-->
    </div><!-- nav modal shell -->

    <div id="the-content-wrapper" class="flex-row flex-center">
      </div id="the-content" class="">

      <!-- -->

        <h3 class="tab-header">Gottfried Liebniz</h3>
        <section class="inform flex-row flex-center"><p class="snippet">
            At the turn of the
            18th Century this German philosopher&mdash;now cannonized as the man who
            invented calculus&mdash;had also invented an arithmetic we now take for granted
            as the binary system.  Being one of the first	European thinkers to take a
            scholarly interst in Chinese civilization, Liebniz would've already seen how
            the ancient <em>I Ching</em>'s hexagrams corresponded to
            the binary numbers 000000 through 111111&mdash;0 to 63.
        </p></section>

        <section class="inform flex-row flex-center"><p class="snippet">
            Liebniz reveled in the <em>I Ching</em>, citing its mere existence as
            affirmation of his own religious beliefs. He even sent a copy of the 64
            hexagrams to the Duke of Brunswick, enclosed with a letter:
            <p class="bolded">
                It is not easy to impart the creation <em>ex nihilo</em>
                through God's almighty power. Now one can say that nothing in the world
                can better present and demonstrate this power better than the origin of
                numbers, as it is presented here through the simple unadorned presentation
                of One and Zero or Nothing.
            </p>
        </p></section>

        <section class="inform flex-row flex-center"><p class="snippet">
             Despite its centrality to his spiritual
             convictions, Liebniz's binary math aroused scant interest among thinkers
             of his era. It was only via happenstance spanning a nearly 140-year
             succession of scholarship that his system fell into place as the
             indispensible object code which we still use to communicate with
             machines.
        </p></section>

        <h3 class="tab-header">George Boole</h3>
        <section class="inform flex-row flex-center"><p class="snippet">
            In 1854 he published
            <em>An Investigation of the Laws of Thought</em>,
            proposing that logic might proceed through a type of algebra based on
            binary variables&mdash;either true or false, represented as 1 or 0&mdash;and the
            formal logical operators of conjunction, disjunction, negation,
            implication, exclusivity, and equivalence.
        </p></section>

        <h3 class="tab-header">Claude E. Shannon</h3>
          <section class="inform flex-row flex-center"><p class="snippet">
            As part of his 1937 master's thesis at MIT, he included a section
            demonstrating that any numerical or logical problem could be navigated
            through the arrangement of electro-mechanical relays using Boolean
            algebra and binary arithmetic.
        </p></section>

        <h3 class="tab-header">George Stibitz</h3>
        <section class="inform flex-row flex-center"><p class="snippet">&Omega;</p></section>

        <h3 class="tab-header">John Atanasoff</h3>
        <section class="inform flex-row flex-center"><p class="snippet">
             In 1939,
             while serving as a physics professor at Iowa State, he
             prototyped what is now recognized as the first digital computer&mdash;an
             electronic device employing vacuum tubes as switches which solved
             simultaneous linear equations through binary math and Boolean logic.
        </p></section>

        <h3 class="tab-header">Grace Hopper</h3>
        <section class="inform flex-row flex-center"><p class="snippet">As part of
             Harvard University's Bureau of Ships Computation Project,
             she pioneered programming of the IBM Automatic Sequence Controlled
             Calculator&mdash;the "Mark I"&mdash;during World War II.  This led to her
             development of A-0&mdash;Arithmetic Language version 0&mdash;which translated
             programmers' source code into binary object code for the newly
             constructed UNIVAC I.  This was the first compiler.
        </p></section>

        <h3 class="tab-header">John VonNeuman</h3>
        <section class="inform flex-row flex-center"><p class="snippet">&Omega;</p></section>

        <h3 class="tab-header">Alan Turing</h3>
        <section class="inform flex-row flex-center"><p class="snippet">&Omega;</p></section>

<!--  -->

      </div> <!-- end content -->
    </div><!-- end wrapper -->

  </div>
  
    <?php

    $html = ob_get_clean();

    return $html;
  }

}

?>
