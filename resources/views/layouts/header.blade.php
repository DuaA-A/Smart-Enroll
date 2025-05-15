<header class="header">
    <div class="logo-container">
        <span class="logo-name">SmartEnroll </span>
    </div>

    <ul class="nav-links">
        <li><a href="#" class="active">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Reviews</a></li>
        <li><a href="#">Contact</a></li>
    </ul>
</header>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    body {
        margin: 0;
    }

    .header {
        display: flex;
        justify-content: space-around;
        align-items: center;
        background: #ffebf0;
        padding: 1% 2%;
        position: relative;
        width: 100%;
        top: 0;
        z-index: 1000;
        border-radius: 0% 0% 30% 30%;
        box-shadow: 0px 2px 20px 2px #880e4f;
    }

    .logo-container {
        display: flex;
        align-items: center;
    }

    .logo-container img {
        height: 50px;
        width: auto;
        margin-right: 10px;
    }

    .logo-name {
        font-size: 30px;
        font-weight: bold;
        color: #880e4f;
        white-space: nowrap;
        position: relative;
    }

        .logo-name::before {
        content: '';
        position: absolute;
        height: 4px;
        width: 5rem;
        left: 0rem;
        bottom: -5px;
        background: linear-gradient(135deg,#ff0080,#ff0080,#ec9ec0,#ece3f0);
        border-radius: 70%;
    }

    .nav-links {
        display: flex;
        list-style: none;
    }

    .nav-links li {
        margin: 0 15px;
    }

    .nav-links a {
        text-decoration: none;
        color: #C10060FF;
        font-size: 15px;
        padding: 5px 15px;
        transition: 0.3s;
        position: relative;
    }



    .nav-links a:hover {
        color: #E73F77FF;
        transform: scale(2);
    }

    @media (max-width: 768px) {
        .header {
            flex-direction: column;
            align-items: center;
            padding: 5px;
            padding-bottom: 4%;
        }

        .nav-links {
            display: none;
            margin-top: 10px;
            flex-direction: column;
            align-items: center;
        }

        .nav-links li {
            margin: 5px 0;
        }

    }
</style>