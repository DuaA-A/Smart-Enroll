<header class="header">
    <div class="logo-container">
        <span class="logo-name">SmartEnroll </span>
    </div>

    <ul class="nav-links">
    <li><a href="#" class="active">{{ __('auth.Home') }}</a></li> 
        <li><a href="#">{{ __('auth.About') }}</a></li>
        <li><a href="#">{{ __('auth.Reviews') }}</a></li>
        <li><a href="#">{{ __('auth.Contact') }}</a></li>
        <li class="language-switcher-container">
            <div class="language-switcher">
                <label for="language-select" class="language-icon">   
                    <i class="fas fa-globe"></i>
                </label>
                <select id="language-select" onchange="switchLanguage(this.value)">
                    @foreach(config('app.available_locales') as $locale)
                        <option value="{{ $locale }}" {{ app()->getLocale() == $locale ? 'selected' : '' }}>
                            {{ __('auth.' . ucfirst($locale)) }}      
                        </option>
                    @endforeach
                </select>
            </div>
        </li>
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
        align-items: center;
    }

    .nav-links li {
        margin: 0 15px;
    }

        .nav-links a:hover {
        color: #E73F77FF;
        transform: scale(1.1);
    }
    .language-switcher-container {
        margin-left: 15px;
        
    }

    .language-switcher {
        display: flex;
        align-items: center;
    }

    .language-switcher select option:hover {
        background-color: #ffebf0 !important; 
        color: #E73F77FF !important; 
    }

    .language-switcher .language-icon {
        color: #C10060FF;
        font-size: 18px;
        cursor: pointer;
        margin-right: 8px;
        transition: all 0.3s ease;
    }


    .language-switcher .language-icon:hover {
         color: #E73F77FF;
        
        transform: scale(1.1);
    }

    .language-switcher select {
    background: white;
    color: #C10060FF;
    font-size: 14px;
    cursor: pointer;
    padding: 8px 30px 8px 12px; 
    border-radius: 5px;
    border: 1px solid #880e4f;
    outline: none;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23C10060FF'%3e%3cpath d='M7 10l5 5 5-5z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 15px;
    min-width: 120px; 
    transition: all 0.3s ease;
}

    /* RTL support for Arabic */
    [dir="rtl"] .language-switcher .language-icon {
        margin-right: 0;
        margin-left: 8px;
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

        .language-switcher {
            margin-left: 0;
            margin-top: 10px;
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


<script>
function switchLanguage(locale) {
    // Get current path without locale prefix
    const currentPath = window.location.pathname;
    const currentLocale = '{{ app()->getLocale() }}';
    let newPath = currentPath;
    
    // Remove current locale prefix if exists
    if (currentPath.startsWith(`/${currentLocale}/`) || currentPath === `/${currentLocale}`) {
        newPath = currentPath.replace(`/${currentLocale}`, '');       
     }
    
    // Add new locale prefix
    newPath = `/${locale}${newPath}`;
    
    window.location.href = newPath;
}
</script>