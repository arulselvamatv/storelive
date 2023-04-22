<footer class="footer text-center ms-auto">
            © 2022 Kare Store by Anand Techverce
            <a href="https://www.anandtechverce.com/">Anand Techverce</a>
        </footer>
        <?php
require_once(__DIR__."/database/connect.php");
$db = new Database;
$db->connect();

$po_qry = ('SELECT `wo_id`, dep_no, work_order.`po_no`, `wo_no`, work_order.`quo_no`, `prod_name`, work_order.`ddl_pro_unit`, work_order.`ddl_pro_qty`, work_order.`product_spec`, work_order.`suplier_id`, s.company_name, `sup_amt`, work_order.`disc_amt`, work_order.`tot`,
            `work_order`.`approved_dt`, `work_order`.`date_time` FROM `work_order` JOIN `suplier` as s ON s.sup_id = work_order.suplier_id JOIN `quot_sup_amt` as qsa ON qsa.quo_no = work_order.quo_no WHERE `work_order`.`active_record`= 1 AND NOW() >= DATE_ADD(`approved_dt`, INTERVAL CAST(timelinedays - 5 AS UNSIGNED) DAY)  GROUP BY `po_no`');
$podata = $db->query($po_qry);
$po_exp_cnt = $podata->rowCount();
?>
<?php
  if($user_id == $admin){ ?>
<!-- Expired PO Notification -->
<div id="popup-modal" class="po-modal">
    <div class="modal-content animated bounce"><a class="modal-close">×</a>
        <div class="modal-text"><h2 style="margin-bottom:20px">Expired PO list</h2></div>
        <div class="modal-footer">
            <div class="table-responsive">
                <table class="table table-bordered" id="123">
                    <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Purchase Order No</th>
                        <th class="text-center">Department No</th>
                        <th class="text-center">Company Name</th>
                        <th class="text-center">Approved</th>
                        <th class="text-center">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 0;
                    while ($po_d = $podata->fetch(PDO::FETCH_ASSOC)) {
                        $i = ++$i;
                        echo '<tr>' .
                            '<th><center>' . $i . '</center></th>' .
                            '<th><center>' . $po_d['po_no'] . '</center></th>' .
                            '<th><center>' . $po_d['dep_no'] . '</center></th>' .
                            '<th><center>' . $po_d['company_name'] . '</center></th>' .
                            '<th><center>' . date('d F Y', strtotime($po_d['approved_dt'])) . '</center></th>' .
                            '<th><center>' . date('d F Y', strtotime($po_d['date_time'])) . '</center></th>' .
                            '</tr>';
                    } ?>
                    <hr>
                    <hr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php  }  ?>
<style>.po-modal, .modal-img img {width: 100%}  .po-modal {display: none;position: fixed;z-index: 9999;padding-top: 100px;left: 0;top: 0;height: 100%;overflow: auto;background-color: rgba(0, 0, 0, .4);font-family: sans-serif}  .modal-content {background-color: #c92727;width: 100%;padding: 15px;overflow: hidden;position: relative;box-sizing: border-box;max-width: 90%;margin: auto;border-radius: 0;border: 0 solid #fcfcfc;-webkit-border-image: url(none) 30 stretch;-o-border-image: url(none) 30 stretch;border-image: url(none) 30 stretch}  .modal-close {float: right;font-weight: 700;color: #fff;font-size: 25px;margin-top: -10px;transition: .2s;cursor: pointer;width: auto}  .modal-close:hover {color: #3b3b3b}  .modal-text {text-align: center;color: #fff}  .modal-text h2 {font-size: 24px;font-weight: 600;font-family: Lato}  .modal-text p {font-size: 17px;margin-top: -15px;margin-bottom: 50px;font-family: Lato}  .modal-footer {padding: 20px 30px;color: rgba(255, 255, 255, .5);width: auto;background-color: #fff;margin: -15px}  input[type=text].modal-input {color: rgba(0, 0, 0, .5);width: 80%;background: #fff;border: none;border-radius: 3px;outline: rgba(0, 0, 0, .5) 0;padding: 15px}  input[type=submit].modal-submit-btn {padding: 14px;font-size: 14px;background-color: #3bb4f5;color: #fff;width: auto;border: none;cursor: pointer;border-radius: 3px;margin-bottom: -13px}  @media screen and (max-width: 27em) {  input[type=text].modal-input {width: 90%;margin-bottom: 0}  input[type=submit].modal-submit-btn {width: 90%}  .modal-text p {font-size: 15px}  }</style>
<script>
    var po_notify = (sessionStorage.getItem('po_notified') !== 'true');
    var po_expiry_count = '<?php echo $po_exp_cnt; ?>';
    var modal = document.getElementById('popup-modal');
    document.getElementsByClassName("modal-close")[0].onclick = function () {
        modal.style.display = "none";
    }

    if(Boolean(po_notify) === true && po_expiry_count > 0){
        setTimeout(function () {
            modal.style.display = "block";
            sessionStorage.setItem('po_notified',true);
        }, 1500);
    }
</script>
        