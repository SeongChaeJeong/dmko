<?php
$sub_menu = '400440';
include_once('./_common.php');

auth_check($auth[$sub_menu], "w");

$g5['title'] = '개인결제 관리';

if ($w == 'u') {
    $html_title = '개인결제 수정';

    $sql = " select * from {$g5['g5_shop_personalpay_table']} where pp_id = '$pp_id' ";
    $pp = sql_fetch($sql);
    if (!$pp['pp_id']) alert('등록된 자료가 없습니다.');
}
else
{
    $html_title = '개인결제 입력';
    $pp['pp_use'] = 1;
}

$wrp_tag_st = '';
$wrp_tag_end = '';
if($popup == 'yes') { // 팝업창일 때
    include_once(G5_PATH.'/head.sub.php');
    $pp['od_id'] = $od_id;
    $sql = " select od_id, od_name, od_misu
                from {$g5['g5_shop_order_table']}
                where od_id = '$od_id' ";
    $od = sql_fetch($sql);

    if(!$od['od_id'])
        alert_close('주문정보가 존재하지 않습니다.');

    $pp['pp_name'] = $od['od_name'];

    if($od['od_misu'] > 0)
        $pp['pp_price'] = $od['od_misu'];
    $wrp_tag_st = '<div class="new_win">'.PHP_EOL.'<h1 id="new_win_title">'.$html_title.'</h1>';
    $wrp_tag_end = '</div>';
}
else { // 현재페이지일 때
    include_once (G5_ADMIN_PATH.'/admin.head.php');
}
$pg_anchor = '<ul class="anchor">
<li><a href="#anc_spp_info">주문 정보</a></li>
<li><a href="#anc_spp_pay">결제 정보</a></li>
</ul>';

// pg 설정 필드 추가
if(!sql_query(" select pp_pg from {$g5['g5_shop_personalpay_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_personalpay_table']}`
                    ADD `pp_pg` varchar(255) NOT NULL DEFAULT '' AFTER `pp_price` ", true);

    // 개인결제 PG kcp로 설정
    sql_query(" update {$g5['g5_shop_personalpay_table']} set pp_pg = 'kcp' ");
}
?>

<form name="fpersonalpayform" action="./personalpayformupdate.php" method="post" onsubmit="return form_check(this);">
<input type="hidden" name="w" value="<?php echo $w; ?>">
<input type="hidden" name="pp_id" value="<?php echo $pp_id; ?>">
<input type="hidden" name="sst" value="<?php echo $sst; ?>">
<input type="hidden" name="sod" value="<?php echo $sod; ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
<input type="hidden" name="stx" value="<?php echo $stx; ?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">
<input type="hidden" name="popup" value="<?php echo $popup; ?>">
<?php if($popup == 'yes') { ?>
<input type="hidden" name="pp_use" value="1">
<?php } ?>

<?php echo $wrp_tag_st; ?>

    <section id="anc_spp_info">
        <h2 class="h2_frm">주문 정보</h2>
        <?php if($popup != 'yes') echo $pg_anchor; ?>
        <div class="local_desc02 local_desc">
            <p>주문 관련 기본 정보입니다.</p>
        </div>

        <div class="tbl_frm01 tbl_wrap">
            <table>
            <caption>주문 정보 목록</caption>
            <colgroup>
                <col class="grid_4">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="pp_name">이름</label></th>
                <td><input type="text" name="pp_name" value="<?php echo $pp['pp_name']; ?>" id="pp_name" required class="required frm_input"></td>
            </tr>
            <tr>
                <th scope="row"><label for="pp_price">주문금액</label></th>
                <td><input type="text" name="pp_price" value="<?php echo $pp['pp_price']; ?>" id="pp_price" required class="required frm_input" size="15"> 원</td>
            </tr>
            <tr>
                <th scope="row"><label for="od_id">주문번호</label></th>
                <td><input type="text" name="od_id" value="<?php echo $pp['od_id'] ? $pp['od_id'] : ''; ?>" id="od_id" class="frm_input" size="20"></td>
            </tr>
            <tr>
                <th scope="row"><label for="pp_content">내용</label></th>
                <td><textarea name="pp_content" id="pp_content" rows="8"><?php echo $pp['pp_content']; ?></textarea></td>
            </tr>
            </tbody>
            </table>
        </div>
    </section>

    <div class="btn_confirm01 btn_confirm">
        <input type="submit" value="확인" class="btn_submit" accesskey="s">
        <?php if($popup == 'yes') { ?>
        <button type="button" onclick="self.close();">닫기</button>
        <?php } else { ?>
        <a href="./personalpaylist.php?<?php echo $qstr; ?>">목록</a>
        <?php } ?>
        <?php if($w == 'u') { ?>
        <a href="./personalpayformupdate.php?w=d&amp;pp_id=<?php echo $pp['pp_id']; ?>" onclick="return del_confirm();">삭제</a>
        <?php } ?>
    </div>

    <?php if($popup != 'yes') { ?>
    <section id="anc_spp_pay" class="cbox">
        <h2>결제 정보</h2>
        <?php echo $pg_anchor; ?>
        <div class="local_desc02 local_desc">
            <p>결제 관련 정보입니다.</p>
        </div>

        <div class="tbl_frm01 tbl_wrap">
            <table>
            <caption>결제 정보 목록</caption>
            <colgroup>
                <col class="grid_4">
                <col>
            </colgroup>
            <tbody>
            <?php if($popup != 'yes') { ?>
            <tr>
                <th scope="row"><label for="pp_receipt_price">결제금액</label></th>
                <td><input type="text" name="pp_receipt_price" value="<?php echo $pp['pp_receipt_price'] ? $pp['pp_receipt_price'] : ''; ?>" id="pp_receipt_price" class="frm_input" size="15"> 원</td>
            </tr>
            <tr>
                <th scope="row"><label for="pp_settle_case">결제방법</label></th>
                <td>
                    <select name="pp_settle_case" id="pp_settle_case">
                        <option value="" <?php echo get_selected($pp['pp_settle_case'], ''); ?>>선택</option>
                        <option value="무통장" <?php echo get_selected($pp['pp_settle_case'], '무통장'); ?>>무통장</option>
                        <option value="계좌이체" <?php echo get_selected($pp['pp_settle_case'], '계좌이체'); ?>>계좌이체</option>
                        <option value="가상계좌" <?php echo get_selected($pp['pp_settle_case'], '가상계좌'); ?>>가상계좌</option>
                        <option value="신용카드" <?php echo get_selected($pp['pp_settle_case'], '신용카드'); ?>>신용카드</option>
                        <option value="휴대폰" <?php echo get_selected($pp['pp_settle_case'], '휴대폰'); ?>>휴대폰</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="pp_receipt_time">결제일시</label></th>
                <td>
                    <input type="checkbox" name="pp_receipt_chk" id="pp_receipt_chk" value="<?php echo date("Y-m-d H:i:s", G5_SERVER_TIME); ?>" onclick="if (this.checked == true) this.form.pp_receipt_time.value=this.form.pp_receipt_chk.value; else this.form.pp_receipt_time.value = this.form.pp_receipt_time.defaultValue;">
                    <label for="pp_receipt_chk">현재 시간으로 설정</label><br>
                    <input type="text" name="pp_receipt_time" value="<?php echo is_null_time($pp['pp_receipt_time']) ? "" : $pp['pp_receipt_time']; ?>" id="pp_receipt_time" class="frm_input" maxlength="19">
                </td>
            </tr>
            <?php } ?>
            <tr>
                <th scope="row"><label for="pp_shop_memo">상점메모</label></th>
                <td><textarea name="pp_shop_memo" id="pp_shop_memo" rows="8"><?php echo $pp['pp_shop_memo']; ?></textarea></td>
            </tr>
            <tr>
                <th scope="row"><label for="pp_use">사용</label></th>
                <td>
                    <select name="pp_use" id="pp_use">
                        <option value="1" <?php echo get_selected($pp['pp_use'], 1); ?>>사용함</option>
                        <option value="0" <?php echo get_selected($pp['pp_use'], 0); ?>>사용안함</option>
                    </select>
                </td>
            </tr>
            </tbody>
            </table>
        </div>
    </section>

    <div class="btn_confirm01 btn_confirm">
        <input type="submit" value="확인" class="btn_submit" accesskey="s">
        <?php if($popup == 'yes') { ?>
        <button type="button" onclick="self.close();">닫기</button>
        <?php } else { ?>
        <a href="./personalpaylist.php?<?php echo $qstr; ?>">목록</a>
        <?php } ?>
        <?php if($w == 'u') { ?>
        <a href="./personalpayformupdate.php?w=d&amp;pp_id=<?php echo $pp['pp_id']; ?>" onclick="return del_confirm();">삭제</a>
        <?php } ?>
    </div>
    <?php } ?>

<?php echo $wrp_tag_end; ?>
</form>

<script>
function form_check(f)
{
    if(f.pp_price.value.replace(/[0-9]/g, "").length > 0) {
        alert("주문금액은 숫자만 입력해 주십시오");
        return false;
    }

    return true;
}

function del_confirm()
{
    return confirm("개인결제 정보를 삭제하시겠습니까?\n\n삭제한 정보는 복구할 수 없습니다.");
}
</script>

<?php
if($popup == 'yes')
    include_once(G5_PATH.'/tail.sub.php');
else
    include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>