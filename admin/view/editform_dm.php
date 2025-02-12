<section class="mt-5 pt-5">
<div class="container-fluid py-5 mb-5 mt-5">
    <h2>CẬP NHẬT DANH MỤC</h2>
    <?php if(isset($kqone) && $kqone): ?>
        <form action="index.php?act=editform_dm" method="post" class="d-flex flex-column">
            <input type="hidden" name="id" value="<?php echo isset($kqone[0]['id']) ? htmlspecialchars($kqone[0]['id']) : ''; ?>">
            
            <label for="tendm" class="mb-1">Tên danh mục</label>
            <input type="text" name="tendm" id="tendm" class="mb-3 form-control" value="<?php echo isset($kqone[0]['tenloai']) ? htmlspecialchars($kqone[0]['tenloai']) : ''; ?>">
            
            <input type="submit" name="themmoi" value="Cập nhật" class="btn btn-primary">
        </form>
    <?php else: ?>
        <p>Không tìm thấy danh mục.</p>
    <?php endif; ?>
</div>
</section>