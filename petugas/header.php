<style>
:root {
    --sidebar-green: #346739;
    --sidebar-light: #79AE6F;
    --active-yellow: #FFDE42;
}

/* SIDEBAR */
.sidebar {
    width: 220px;
    height: 100vh;
    position: fixed;
    background: linear-gradient(to bottom, var(--sidebar-green), var(--sidebar-light));
    color: white;
    padding-top: 20px;
}

.sidebar h2 {
    text-align: center;
}

.sidebar a {
    display: block;
    padding: 15px 20px;
    color: white;
    text-decoration: none;
}

.sidebar a.active {
    background: var(--active-yellow);
    color: black;
    border-radius: 20px;
    margin: 5px;
}

.sidebar a i {
    margin-right: 10px;
}

/* MAIN */
.main-content {
    margin-left: 220px;
}

/* HEADER */
.header {
    background: linear-gradient(to right, #FFDE42, #ffffff);
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-title {
    font-size: 26px;
    font-weight: bold;
}

.header-logo {
    width: 50px;
}
</style>

<div class="sidebar">
    <h2>E-Parking<br>System</h2>

    <a href="index.php" class="active"><i class="bi bi-house"></i> Dashboard</a>
    <a href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<div class="main-content">
    <div class="header">
        <div class="header-title">Dashboard Petugas</div>
        <img src="../logo.png" class="header-logo">
    </div>