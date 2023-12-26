</div>

  <script src="/assets/js/jquery-3.2.1.min.js"></script>

<!-- Bootstrap Core JS -->
  <script src="/assets/js/popper.min.js"></script>
  <script src="/assets/js/bootstrap.min.js"></script>

<!-- Slimscroll JS -->
  <script src="/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

  <script src="/assets/js/moment.min.js"></script>
  <script src="/assets/js/bootstrap-datetimepicker.min.js"></script>
  <script src="/assets/js/jquery-ui.min.js"></script>
  <script src="/assets/plugins/fullcalendar/fullcalendar.min.js"></script>
  <script src="/assets/plugins/fullcalendar/jquery.fullcalendar.js"></script>


<!-- Custom JS -->
<script src="/assets/js/script.js?<?=time();?>"></script>
<?php if (isset($err) && !empty($err)) { ?>
<script>alert('<?=$err;?>');</script>
<? } ?>
</body>
</html>
