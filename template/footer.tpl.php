  <br clear="both"/></div></div></div><br clear="both"/><br/><br/><br/>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/instantclick@3.1.0-2/dist/instantclick.min.js" integrity="sha256-t+8lNgpgIt9SLCOQSNPyLDKBmKrtQz5FAhF5jCFLk8I=" crossorigin="anonymous"></script>
  <script data-no-instant>InstantClick.init();
    <?php
    if (!empty($err)) {
     ?>
    alert('<?=$err;?>');
    <? } ?>

   </script>

</div>
</div>

<br clear="both"/>
<br/>
<br/>

   <div class="footer">
     <div style="max-width: 1024px; margin: 0 auto; text-align:center;">


       <a href="/privacy-policy"  style="padding:10px 10px;">Privacy Policy</a>
       -
       <a href="/terms-and-conditions"  style="padding:10px 10px;">Terms & Conditions</a>



            <div style="margin-top:10px;">© 2022 Ritma. All Rights Reserved.</div>
      </div>      </div>

<style>
  .footer {
    background-color: #232323;
    padding:40px 0px;
    color: white;
  }

  .modal-dialog {
    max-width: 90%;
    text-align: left;
    max-width: 800px;
    font-size:14px;
line-height: 20px;
  }

  h3 {
    margin: 0; padding: 0;
  }

  /* Customize the label (the container-checkbox) */
  .container-checkbox {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    font-weight: normal;
    user-select: none;
  }

  /* Hide the browser's default checkbox */
  .container-checkbox input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
  }

  /* Create a custom checkbox */
  .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
  }

  /* On mouse-over, add a grey background color */
  .container-checkbox:hover input ~ .checkmark {
    background-color: #ccc;
  }

  /* When the checkbox is checked, add a blue background */
  .container-checkbox input:checked ~ .checkmark {
    background-color: #e10030;
  }

  /* Create the checkmark/indicator (hidden when not checked) */
  .checkmark:after {
    content: "";
    position: absolute;
    display: none;
  }

  .container-checkbox {
    margin-top: 10px;
  }

  /* Show the checkmark when checked */
  .container-checkbox input:checked ~ .checkmark:after {
    display: block;
  }

  /* Style the checkmark/indicator */
  .container-checkbox .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
  }

</style>


</body>
</html>
