<?php
include("..\config.php");
include("../includes/functions.php");

?>

<?php include ('../template/header_admin.php')?>

<body>
<?php include ('sidebar-admin.php')?>
    <!-- CONTENT -->
    <section id="content">
        <?php include("../template/navBar_admin.php")?>
        <!-- MAIN -->
        <main> 
        <!--Colleges List-->
            <div id="data-info-content">
                <h1>data</h1>
                <form action="add_table.php" method="post">
                    <label for="tableName">Table Name:</label><br>
                    <input type="text" id="tableName" name="tableName"><br><br>
                    <input type="submit" value="Add Table">
                </form>
            </div>
            </main>
        <!-- MAIN -->

</section>
<?php include ('profile.php')?>
<?php include ('script.php')?>
<!-- CONTENT -->
<?php include("../template/footer.php")?>