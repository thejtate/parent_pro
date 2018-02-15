<?php $title = '13-1496-Parent-Pro-web-CALENDAR'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body class="page page-services-questionaire">
<div class="outer-wrapper">
  <?php include 'tpl/layout/header.inc'; ?>
  <div class="inner-wrapper">

    <div class="content-wrapper">
      <div class="content-top">
        <div class="content-top-inner">
          <h1>Services Questionaire</h1>

          <div class="btn-wrap style-a">
            <a href="#" class="btn">Back to your county</a>
          </div>
        </div>
      </div>
      <div class="content-inner">
        <div class="content-bottom">
          <div class="form form-services">

            <fieldset>
              <legend>What services are you most interested in for your family? (select all that apply)</legend>
              <div class="form-item form-type-checkbox">
                <input type="checkbox" class="form-checkbox" name="1" id="form-check-1">
                <label for="form-check-1">Child’s Health </label>
              </div>

              <div class="form-item form-type-checkbox">
                <input type="checkbox" class="form-checkbox" name="1" id="form-check-2">
                <label for="form-check-2">Parent’s Health </label>
              </div>

              <div class="form-item form-type-checkbox">
                <input type="checkbox" class="form-checkbox" name="1" id="form-check-3">
                <label for="form-check-3">Parenting Stress</label>
              </div>

              <div class="form-item form-type-checkbox">
                <input type="checkbox" class="form-checkbox" name="1" id="form-check-4">
                <label for="form-check-4">Child Development</label>
              </div>

              <div class="form-item form-type-checkbox">
                <input type="checkbox" class="form-checkbox" name="1" id="form-check-5">
                <label for="form-check-5">School Readiness</label>
              </div>
            </fieldset>

            <fieldset>
              <legend>Tell us about your family. Choose the ONE that best describes your family.</legend>
              <div class="form-item form-type-radio">
                <input type="radio" class="form-radio" name="1" checked="" id="form-radio-1">
                <label for="form-radio-1">Less than 29 weeks in pregnancy</label>
              </div>

              <div class="form-item form-type-radio">
                <input type="radio" class="form-radio" name="1" checked="" id="form-radio-2">
                <label for="form-radio-2">Pregnant with first child and in 29th week of pregnancgy or beyond </label>
              </div>

              <div class="form-item form-type-radio">
                <input type="radio" class="form-radio" name="1" checked="" id="form-radio-3">
                <label for="form-radio-3">Pregnant, but not with first child </label>
              </div>

              <div class="form-item form-type-radio">
                <input type="radio" class="form-radio" name="1" checked="" id="form-radio-4">
                <label for="form-radio-4">Not pregnant but have at least one child under 12 months old</label>
              </div>

              <div class="form-item form-type-radio">
                <input type="radio" class="form-radio" name="1" checked="" id="form-radio-5">
                <label for="form-radio-5">Not pregnant, but have at least one child over 12 months and under 24
                  months </label>
              </div>
              <div class="form-item form-type-radio">
                <input type="radio" class="form-radio" name="1" checked="" id="form-radio-6">
                <label for="form-radio-6">Not pregnant, but have at least one child five or under</label>
              </div>
              <div class="form-item form-type-radio">
                <input type="radio" class="form-radio" name="1" checked="" id="form-radio-7">
                <label for="form-radio-7">None of the above</label>
              </div>
            </fieldset>

            <fieldset>
              <legend>Are you eligible for WIC and/or Medicaid?</legend>
              <div class="form-item form-type-radio">
                <input type="radio" class="form-radio" name="1" checked="" id="form-radio-8">
                <label for="form-radio-8">Yes</label>
              </div>

              <div class="form-item form-type-radio">
                <input type="radio" class="form-radio" name="1" checked="" id="form-radio-9">
                <label for="form-radio-9">No </label>
              </div>

              <div class="form-item form-type-radio">
                <input type="radio" class="form-radio" name="1" checked="" id="form-radio-10">
                <label for="form-radio-10">Don’t know</label>
              </div>
            </fieldset>

            <fieldset>
              <legend>Rank the level of stress in your home.</legend>
              <div class="form-item form-type-radio">
                <input type="radio" class="form-radio" name="1" checked="" id="form-radio-11">
                <label for="form-radio-11">Low</label>
              </div>

              <div class="form-item form-type-radio">
                <input type="radio" class="form-radio" name="1" checked="" id="form-radio-12">
                <label for="form-radio-12">Moderate</label>
              </div>

              <div class="form-item form-type-radio">
                <input type="radio" class="form-radio" name="1" checked="" id="form-radio-13">
                <label for="form-radio-13">Hight</label>
              </div>
            </fieldset>

            <fieldset>
              <legend>Rank the level of stress in your home.</legend>
              <div class="form-item form-type-radio">
                <input type="radio" class="form-radio" name="1" checked="" id="form-radio-14">
                <label for="form-radio-14">English</label>
              </div>

              <div class="form-item form-type-radio">
                <input type="radio" class="form-radio" name="1" checked="" id="form-radio-15">
                <label for="form-radio-15">Español</label>
              </div>
            </fieldset>
            <fieldset>
              <div class="form-item form-type-textfield">
                <label>What is your name?</label>
                <input type="text" class="form-text" placeholder="First Name">
              </div>
              <div class="form-item form-type-textfield">
                <label></label>
                <input type="text" class="form-text" placeholder="Last Name">
              </div>
            </fieldset>
            <fieldset>
              <div class="form-type-textfield">
                <label>What is your phone number?</label>
                <input type="text" class="form-text" placeholder="">
              </div>
              <div class="form-type-textfield">
                <label>What is your e-mail address?</label>
                <input type="text" class="form-text" placeholder="">
              </div>
            </fieldset>

            <div class="btn-wrap">
              <input type="submit" class="form-submit" value="submit">
            </div>


          </div>

          <div class="thanks">
            <h3>Thank you, your information has been sent. <br/>
              A parentPRO representative will contact you shortly to discuss the <br/> services that will best serve you
              and
              your family.</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'tpl/layout/footer.inc'; ?>
</div>
</body>
</html>