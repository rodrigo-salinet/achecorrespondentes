<?php
mysqli_close($conn);
mysqli_free_result();
ob_end_flush();
?>