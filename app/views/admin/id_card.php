<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Member ID Card</title>
<style>
@page {
    size: 190.5mm 100.54mm landscape;
    margin: 0;
    padding: 0;
}
body{
    margin:0;
    padding:0;
    background:#ffffff;
    font-family: Arial, Helvetica, sans-serif;
    width: 190.5mm;
    height: 100.54mm;
}

/* CARD OUTER TABLE */
.id-card-wrapper {
    width: 190.5mm;
    height: 100.54mm;
    border-collapse: collapse;
    margin: 0;
    padding: 0;
    table-layout: fixed;
}

/* LEFT COLUMN */
.left-side {
    width: 95.25mm;
    height: 100.54mm;
    padding: 8mm;
    text-align: center;
    vertical-align: middle;
    background: #ffffff;
}

.member-photo {
    width: 38mm;
    height: 38mm;
    border-radius: 50%;
    border: 1.6mm solid #c62828;
}

.member-name {
    font-size: 20pt;
    font-weight: bold;
    color: #c62828;
    margin-top: 3mm;
}

.reg-no {
    font-size: 14pt;
    font-weight: bold;
    color: #000000;
    margin-top: 2mm;
}

.qr-code-box {
    margin-top: 5mm;
}

/* RIGHT COLUMN - RED SIDE */
.right-side {
    width: 95.25mm;
    height: 100.54mm;
    padding: 8mm;
    background: #c62828;
    background-image: linear-gradient(135deg, #c62828, #961d1d);
    color: #ffffff;
    vertical-align: top;
}

/* HEADER AREA (LOGO + ORG) */
.right-header-table {
    width: 100%;
    margin-bottom: 5mm;
}

.org-logo {
    width: 20mm;
    height: 20mm;
}

.org-title {
    font-size: 13pt;
    font-weight: bold;
    padding-left: 4mm;
    color: #ffffff;
    line-height: 1.3;
}

.main-company-title {
    font-size: 16pt;
    font-weight: bold;
    margin-bottom: 10mm;
    margin-top: 3mm;
}

/* DETAILS SECTION */
.details-container {
    font-size: 12pt;
    line-height: 1.9;
}

.details-row {
    margin-bottom: 4px;
}

.label-text {
    font-weight: bold;
}

/* FOOTER */
.footer-note {
    margin-top: 8mm;
    font-size: 11pt;
    opacity: 0.9;
}

</style>
</head>
<body>
<table class="id-card-wrapper" cellpadding="0" cellspacing="0">
    <tr>
        <!-- LEFT SIDE -->
        <td class="left-side">
            <img src="<?= $photoPath ?>" class="member-photo">
            
            <div class="member-name">
                <?= htmlspecialchars($member['fname'] . ' ' . $member['lname']) ?>
            </div>

            <div class="reg-no">
                Reg No: #<?= htmlspecialchars($member['reg_no']) ?>
            </div>

            <div class="qr-code-box">
                <barcode code="<?= $qrData ?>" type="QR" size="0.75" error="M" disableborder="1" />
            </div>
        </td>

        <!-- RIGHT SIDE -->
        <td class="right-side">
            <table class="right-header-table" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="20mm">
                        <img src="<?= $logoPath ?>" class="org-logo">
                    </td>
                    <td class="org-title">
                        <?= htmlspecialchars($member['membership']) ?>
                    </td>
                </tr>
            </table>

            <div class="main-company-title">Kerala Congress</div>

            <div class="details-container">
                <div class="details-row"><span class="label-text">DOB:</span> <?= htmlspecialchars($dob) ?></div>
                <div class="details-row"><span class="label-text">District:</span> <?= htmlspecialchars($member['district_name'] ?? $member['district']) ?></div>
                <div class="details-row"><span class="label-text">Assembly:</span> <?= htmlspecialchars($member['assembly_name'] ?? $member['assembly']) ?></div>
                <div class="details-row"><span class="label-text">Blood Group:</span> <?= htmlspecialchars($member['blood'] ?? 'N/A') ?></div>
            </div>

            <div class="footer-note">
                Official Membership Card
            </div>
        </td>
    </tr>
</table>
</body>
</html>