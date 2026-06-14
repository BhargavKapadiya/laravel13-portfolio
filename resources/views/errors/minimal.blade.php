<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Styles -->
        <style>
            @import url('https://fonts.googleapis.com/css?family=Nunito+Sans');
            :root {
            --blue: #1a1a1a;
            --white: #fff;
            --green: #0dac72;
            }
            html,
            body {
                height: 100%;
                margin: 0;
            }
            body {
                display: flex;
                align-items: center;
                justify-content: center;
                font-family:"Nunito Sans";
                color: var(--blue);
                font-size: 1em;
            }
            button {
                font-family:"Nunito Sans";
            }
            ul {
                list-style-type: none;
                padding-inline-start: 35px;
            }
            svg {
                width: 100%;
                visibility: hidden;
            }
            h1 {
                font-size: 7.5em;
                margin: 15px 0px;
                font-weight:bold;
            }
            h2 {
                font-weight:bold;
            }
            .btn {
                z-index: 1;
                overflow: hidden;
                background: transparent;
                position: relative;
                padding: 8px 50px;
                border-radius: 30px;
                cursor: pointer;
                font-size: 1em;
                letter-spacing: 2px;
                transition: 0.2s ease;
                font-weight: bold;
                margin: 5px 0px;
                text-decoration: none;
                margin-top: 10px; 
                &.green {
                    border: 4px solid var(--green);
                    color: var(--blue);
                    &:before {
                        content: "";
                        position: absolute;
                        left: 0;
                        top: 0;
                        width: 0%;
                        height: 100%;
                        background: var(--green);
                        z-index: -1;
                        transition: 0.2s ease;
                        border-radius: 30px;
                    }
                    &:hover {
                        color: var(--white);
                        background: var(--green);
                        transition: 0.2s ease;
                        &:before {
                            width: 100%;
                        }
                    }
                }
            }
            @media screen and (max-width:768px) {
            body {
                display:block;
            }
            .container {
                margin-top:70px;
                margin-bottom:70px;
            }
            } 

            .btn {
                --bs-btn-padding-x: 1.2rem;
                --bs-btn-padding-y: 0.5rem;
                --bs-btn-font-size: 0.8rem;
                --bs-btn-font-weight: 700;
                --bs-btn-line-height: 1.7;
                --bs-btn-color: var(--bs-body-color);
                --bs-btn-bg: transparent;
                --bs-btn-border-width: 2px;
                --bs-btn-border-color: transparent;
                --bs-btn-border-radius: 0.4rem;
                --bs-btn-hover-border-color: transparent;
                --bs-btn-box-shadow: unset;
                --bs-btn-disabled-opacity: 0.65;
                --bs-btn-focus-box-shadow: 0 0 0 0.25rem rgba(var(--bs-btn-focus-shadow-rgb), .5);
                --bs-primary: #e52961;
                --bs-white: #fff;
                --bs-btn-color: #fff;
                --bs-btn-bg: #e52961;
                --bs-btn-border-color: #e52961;
                --bs-btn-hover-color: #fff;
                --bs-btn-hover-bg: #e52961;
                --bs-btn-hover-border-color: #e52961;
                --bs-btn-focus-shadow-rgb: 92,140,229;
                --bs-btn-active-color: #fff;
                --bs-btn-active-bg: #e52961;
                --bs-btn-active-border-color: #e52961;
                --bs-btn-active-shadow: 0rem 0.25rem 0.75rem rgba(30, 34, 40, 0.15);
                --bs-btn-disabled-color: #fff;
                --bs-btn-disabled-bg: #e52961;
                --bs-btn-disabled-border-color: #e52961;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                transform: translateY(0);
                letter-spacing: -.01rem;
                position: relative;
                padding: var(--bs-btn-padding-y) var(--bs-btn-padding-x);
                font-family: var(--bs-btn-font-family);
                font-size: var(--bs-btn-font-size);
                font-weight: var(--bs-btn-font-weight);
                line-height: var(--bs-btn-line-height);
                color: var(--bs-btn-color);
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                cursor: pointer;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
                border: var(--bs-btn-border-width) solid var(--bs-btn-border-color);
                border-radius: var(--bs-btn-border-radius);
                background-color: var(--bs-btn-bg);
                box-shadow: var(--bs-btn-box-shadow);
                transition: all .2s ease-in-out;
            }
            .rounded-pill {
                border-radius: 50rem!important;
            }
            
            .btn-primary {
                background-color: var(--bs-btn-bg);
                color: var(--bs-white)
            }
        </style>
    </head>
    <body>
        <main>
            <div class="container">
              <div class="row">
                <div class="col-md-6 align-self-center">
                  <h1>@yield('code')</h1>
                  
                  @yield('message')
                </div>
              </div>
            </div>
          </main>
    </body>
</html>
