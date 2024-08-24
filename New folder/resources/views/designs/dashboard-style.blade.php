@extends('layouts.app')

@section('title', 'Dashboard Design')
@section('css')
    <style>
        .sidebar-customizer,
        .sidebar,
        .card-customizer {}

        .customizer-main {
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }


        .customizer-main h1 {
            margin-bottom: 20px;
        }


        .customizer-main div {
            margin-bottom: 15px;
        }


        .customizer-main label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }



        .customizer-main input[type="text"],
        .customizer-maininput[type="color"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }


        .customizer-main button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background: #007bff;
            color: #fff;
            cursor: pointer;
            margin-right: 10px;
        }


        .customizer-main button:hover {
            background: #0056b3;
        }

        .sidebar {
            flex: 1;
        }

        .sidebar-v2 nav {
            display: flex;
            flex-direction: column;
            width: 200px;
        }

        .sidebar-v2 a {
            display: block;
            padding: 10px;
            color: #333;
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
        }

        .sidebar-v2 a:hover {
            background: #555;
            color: #fff;
        }

        .gradient-color-row {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 10px;
        }

        .gradient-color-row input[type="color"] {
            width: 30px;
            height: 30px;
            margin-right: 5px;
        }

        .sidebar {
            flex: 1;
            background-color: #2d3748;
            color: #fff;

        }

        .sidebar a {
            display: block;
            padding: 10px;
            color: #fff;
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
        }

        .sidebar a:hover {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity));
            opacity: 1;
            background: #1a202c;
            border-radius: 5px
        }

        .chart-container {
            text-align: center;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            margin-top: 20px;
        }

        .gr-colors {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: 10px;
        }

        [id*='bgGradientType'] {
            margin-top: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Design Dashboard</li>
                    </ol>
                </div>
                <h4 class="page-title">Design Dashboard</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div>
    <!-- end page title end breadcrumb -->

    <div class="container-fluid">
        <div class="row">
            <form id="customizerForm">
                @csrf
                <div class="col-md-12">

                    <div class="container">
                        {{-- global customizations --}}
                        <div class="row">
                            <div class="col-md-8">
                                <div class="global-customizer customizer-main">
                                    <h1>Global Customizer</h1>
                                    <div hidden>
                                        <label for="globalfontSize">Font Size</label>
                                        <input type="text" id="globalfontSize" name="globalfontSize"
                                            placeholder="e.g., 16px" oninput="applyStylesGlobal()">
                                    </div>
                                    <div class="color-div">
                                        <label for="globalfontColor">Font Color</label>
                                        <input type="radio" id="globalfontColorCodeRadio" name="globalfontColorType"
                                            value="code" {{ $css_json['globalfontColorType'] == 'code' ? 'checked' : '' }}
                                            onclick="toggleColorInput('globalfontColor')"> Code
                                        <input type="radio" id="globalfontColorPickerRadio" name="globalfontColorType"
                                            value="picker"
                                            {{ $css_json['globalfontColorType'] == 'picker' ? 'checked' : '' }}
                                            onclick="toggleColorInput('globalfontColor')"> Picker
                                        <br>
                                        <input type="text" id="globalfontColorCode" name="globalfontColor"
                                            placeholder="e.g., #000000"
                                            value="{{ $css_json['globalfontColorType'] == 'code' ? $css_json['globalfontColor'] : '' }}"
                                            style="{{ $css_json['globalfontColorType'] == 'picker' ? 'display:none;' : '' }}"
                                            oninput="applyStylesGlobal()">
                                        <input type="color" id="globalfontColorPicker" name="globalfontColor"
                                            value="{{ $css_json['globalfontColorType'] == 'picker' ? $css_json['globalfontColor'] : '' }}"
                                            style="{{ $css_json['globalfontColorType'] == 'code' ? 'display:none;' : '' }}"
                                            oninput="applyStylesGlobal()">
                                    </div>


                                    <div>
                                        <label for="globalbgColor">Body Background Color</label>
                                        <input type="radio" id="globalbgColorCodeRadio" name="globalbgColorType"
                                            value="code"
                                            {{ isset($css_json['globalbgColorType']) && $css_json['globalbgColorType'] == 'code' ? 'checked' : '' }}
                                            onclick="toggleColorInput('globalbgColor')"> Code
                                        <input type="radio" id="globalbgColorPickerRadio" name="globalbgColorType"
                                            value="picker"
                                            {{ isset($css_json['globalbgColorType']) && $css_json['globalbgColorType'] == 'picker' ? 'checked' : '' }}
                                            onclick="toggleColorInput('globalbgColor')"> Picker
                                        <input type="radio" id="globalbgGradientRadio" name="globalbgColorType"
                                            value="gradient"
                                            {{ isset($css_json['globalbgColorType']) && $css_json['globalbgColorType'] == 'gradient' ? 'checked' : '' }}
                                            onclick="toggleColorInput('globalbgColor')"> Gradient
                                        <input type="text" id="globalbgColorCode" name="globalbgColor"
                                            placeholder="e.g., #ffffff"
                                            value="{{ isset($css_json['globalbgColorType']) && $css_json['globalbgColorType'] == 'code' ? $css_json['globalbgColor'] : '' }}"
                                            style="{{ !isset($css_json['globalbgColorType']) || $css_json['globalbgColorType'] != 'code' ? 'display:none;' : '' }}"
                                            oninput="applyStylesGlobal()">
                                             <br>
                                        <input type="color" id="globalbgColorPicker" name="globalbgColor"
                                            value="{{ isset($css_json['globalbgColorType']) && $css_json['globalbgColorType'] == 'picker' ? $css_json['globalbgColor'] : '' }}"
                                            style="{{ !isset($css_json['globalbgColorType']) || $css_json['globalbgColorType'] != 'picker' ? 'display:none;' : '' }}"
                                            oninput="applyStylesGlobal()">
                                        <div id="globalbgGradientContainer"
                                            style="{{ !isset($css_json['globalbgColorType']) || $css_json['globalbgColorType'] != 'gradient' ? 'display:none;' : '' }}">
                                            <select id="globalbgGradientType" onchange="applyStylesGlobal()">
                                                <option value="to right"
                                                    {{ isset($css_json['globalbgGradientType']) && $css_json['globalbgGradientType'] == 'to right' ? 'selected' : '' }}>
                                                    To Right</option>
                                                <option value="to left"
                                                    {{ isset($css_json['globalbgGradientType']) && $css_json['globalbgGradientType'] == 'to left' ? 'selected' : '' }}>
                                                    To Left</option>
                                                <option value="to top"
                                                    {{ isset($css_json['globalbgGradientType']) && $css_json['globalbgGradientType'] == 'to top' ? 'selected' : '' }}>
                                                    To Top</option>
                                                <option value="to bottom"
                                                    {{ isset($css_json['globalbgGradientType']) && $css_json['globalbgGradientType'] == 'to bottom' ? 'selected' : '' }}>
                                                    To Bottom</option>
                                            </select>
                                            <div id="globalbgGradientColors" class="gr-colors">
                                                @if (isset($css_json['globalbgGradientColors']) && is_array($css_json['globalbgGradientColors']))
                                                    @foreach ($css_json['globalbgGradientColors'] as $index => $color)
                                                        <div class="gradient-color-row">
                                                            <label for="globalbgGradientColor{{ $index + 1 }}">Color
                                                                {{ $index + 1 }}:</label>
                                                            <input type="color"
                                                                id="globalbgGradientColor{{ $index + 1 }}"
                                                                class="globalbgGradientColor" value="{{ $color }}"
                                                                oninput="applyStylesGlobal()">
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <button type="button" onclick="addGradientColorGlobal()">Add Color</button>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="globalfontFamily">Font Family</label>
                                        <input type="text" id="globalfontFamily" name="globalfontFamily"
                                            placeholder="e.g., Arial" oninput="applyStylesGlobal()">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- navbar styles customizations --}}
                        <div class="row mt-5">
                            <div class="col-md-8">
                                <div class="sidebar-customizer customizer-main">
                                    <h1>Sidebar Customizer</h1>

                                    <div>
                                        <label for="fontSize">Font Size</label>
                                        <input type="text" id="fontSize" name="fontSize" placeholder="e.g., 16px"
                                            value="{{ isset($css_json['fontSize']) ? $css_json['fontSize'] : '' }}"
                                            oninput="applyStyles()">
                                    </div>

                                    <div>
                                        <label for="fontColor">Font Color</label>
                                        <input type="radio" id="fontColorCodeRadio" name="fontColorType"
                                            value="code"
                                            {{ isset($css_json['fontColorType']) && $css_json['fontColorType'] == 'code' ? 'checked' : 'checked' }}
                                            onclick="toggleColorInput('fontColor')"> Code
                                        <input type="radio" id="fontColorPickerRadio" name="fontColorType"
                                            value="picker"
                                            {{ isset($css_json['fontColorType']) && $css_json['fontColorType'] == 'picker' ? 'checked' : '' }}
                                            onclick="toggleColorInput('fontColor')"> Picker
                                        <input type="text" id="fontColorCode" name="fontColor"
                                            placeholder="e.g., #000000"
                                            value="{{ isset($css_json['fontColor']) && $css_json['fontColorType'] == 'code' ? $css_json['fontColor'] : '' }}"
                                            style="{{ !isset($css_json['fontColorType']) || $css_json['fontColorType'] != 'code' ? 'display:none;' : '' }}"
                                            oninput="applyStyles()">
                                            <br>
                                        <input type="color" id="fontColorPicker" name="fontColor"
                                            value="{{ isset($css_json['fontColor']) && $css_json['fontColorType'] == 'picker' ? $css_json['fontColor'] : '' }}"
                                            style="{{ !isset($css_json['fontColorType']) || $css_json['fontColorType'] != 'picker' ? 'display:none;' : '' }}"
                                            oninput="applyStyles()">
                                    </div>

                                    <div>
                                        <label for="bgColor">Background Color</label>
                                        <input type="radio" id="bgColorCodeRadio" name="bgColorType" value="code"
                                            {{ isset($css_json['bgColorType']) && $css_json['bgColorType'] == 'code' ? 'checked' : 'checked' }}
                                            onclick="toggleColorInput('bgColor')"> Code
                                        <input type="radio" id="bgColorPickerRadio" name="bgColorType" value="picker"
                                            {{ isset($css_json['bgColorType']) && $css_json['bgColorType'] == 'picker' ? 'checked' : '' }}
                                            onclick="toggleColorInput('bgColor')"> Picker
                                        <input type="radio" id="bgGradientRadio" name="bgColorType" value="gradient"
                                            {{ isset($css_json['bgColorType']) && $css_json['bgColorType'] == 'gradient' ? 'checked' : '' }}
                                            onclick="toggleColorInput('bgColor')"> Gradient
                                        <input type="text" id="bgColorCode" name="bgColor"
                                            placeholder="e.g., #ffffff"
                                            value="{{ isset($css_json['bgColor']) && $css_json['bgColorType'] == 'code' ? $css_json['bgColor'] : '' }}"
                                            style="{{ !isset($css_json['bgColorType']) || $css_json['bgColorType'] != 'code' ? 'display:none;' : '' }}"
                                            oninput="applyStyles()">
                                             <br>
                                        <input type="color" id="bgColorPicker" name="bgColor"
                                            value="{{ isset($css_json['bgColor']) && $css_json['bgColorType'] == 'picker' ? $css_json['bgColor'] : '' }}"
                                            style="{{ !isset($css_json['bgColorType']) || $css_json['bgColorType'] != 'picker' ? 'display:none;' : '' }}"
                                            oninput="applyStyles()">
                                        <div id="bgGradientContainer"
                                            style="{{ !isset($css_json['bgColorType']) || $css_json['bgColorType'] != 'gradient' ? 'display:none;' : '' }}">
                                            <select id="bgGradientType" onchange="applyStyles()">
                                                <option value="to right"
                                                    {{ isset($css_json['bgGradientType']) && $css_json['bgGradientType'] == 'to right' ? 'selected' : '' }}>
                                                    To Right</option>
                                                <option value="to left"
                                                    {{ isset($css_json['bgGradientType']) && $css_json['bgGradientType'] == 'to left' ? 'selected' : '' }}>
                                                    To Left</option>
                                                <option value="to top"
                                                    {{ isset($css_json['bgGradientType']) && $css_json['bgGradientType'] == 'to top' ? 'selected' : '' }}>
                                                    To Top</option>
                                                <option value="to bottom"
                                                    {{ isset($css_json['bgGradientType']) && $css_json['bgGradientType'] == 'to bottom' ? 'selected' : '' }}>
                                                    To Bottom</option>
                                            </select>
                                            <div id="bgGradientColors" class="gr-colors">
                                                @if (isset($css_json['bgGradientColors']) && is_array($css_json['bgGradientColors']))
                                                    @foreach ($css_json['bgGradientColors'] as $index => $color)
                                                        <div class="gradient-color-row">
                                                            <label for="bgGradientColor{{ $index + 1 }}">Color
                                                                {{ $index + 1 }}:</label>
                                                            <input type="color" id="bgGradientColor{{ $index + 1 }}"
                                                                class="bgGradientColor" value="{{ $color }}"
                                                                oninput="applyStyles()">
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <button type="button" onclick="addGradientColor()">Add Color</button>
                                        </div>
                                    </div>

                                    <div hidden>
                                        <label for="fontFamily">Font Family</label>
                                        <input type="text" id="fontFamily" name="fontFamily"
                                            placeholder="e.g., Arial"
                                            value="{{ isset($css_json['fontFamily']) ? $css_json['fontFamily'] : '' }}"
                                            oninput="applyStyles()">
                                    </div>

                                    <div>
                                        <label for="hoverBgColor">Hover Background Color</label>
                                        <input type="radio" id="hoverBgColorCodeRadio" name="hoverBgColorType"
                                            value="code"
                                            {{ isset($css_json['hoverBgColorType']) && $css_json['hoverBgColorType'] == 'code' ? 'checked' : 'checked' }}
                                            onclick="toggleColorInput('hoverBgColor')"> Code
                                        <input type="radio" id="hoverBgColorPickerRadio" name="hoverBgColorType"
                                            value="picker"
                                            {{ isset($css_json['hoverBgColorType']) && $css_json['hoverBgColorType'] == 'picker' ? 'checked' : '' }}
                                            onclick="toggleColorInput('hoverBgColor')"> Picker
                                        <input type="text" id="hoverBgColorCode" name="hoverBgColor"
                                            placeholder="e.g., #dddddd"
                                            value="{{ isset($css_json['hoverBgColor']) && $css_json['hoverBgColorType'] == 'code' ? $css_json['hoverBgColor'] : '' }}"
                                            style="{{ !isset($css_json['hoverBgColorType']) || $css_json['hoverBgColorType'] != 'code' ? 'display:none;' : '' }}"
                                            oninput="applyStyles()">
                                             <br>
                                        <input type="color" id="hoverBgColorPicker" name="hoverBgColor"
                                            value="{{ isset($css_json['hoverBgColor']) && $css_json['hoverBgColorType'] == 'picker' ? $css_json['hoverBgColor'] : '' }}"
                                            style="{{ !isset($css_json['hoverBgColorType']) || $css_json['hoverBgColorType'] != 'picker' ? 'display:none;' : '' }}"
                                            oninput="applyStyles()">
                                    </div>

                                    <div>
                                        <label for="padding">Padding</label>
                                        <input type="text" id="padding" name="padding" placeholder="e.g., 10px"
                                            value="{{ isset($css_json['padding']) ? $css_json['padding'] : '' }}"
                                            oninput="applyStyles()">
                                    </div>

                                    <div>
                                        <label for="margin">Margin</label>
                                        <input type="text" id="margin" name="margin" placeholder="e.g., 5px"
                                            value="{{ isset($css_json['margin']) ? $css_json['margin'] : '' }}"
                                            oninput="applyStyles()">
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="sidebar customizer-main" id="sidebar-v2">
                                    <div class="nav-header">
                                        <div class="text-center flex-shrink-0 md:px-1 mb-3 agency-logo-container px-3">
                                            <img src="https://cdn.pixabay.com/photo/2017/03/16/21/18/logo-2150297_640.png"
                                                alt="Logo" height="40" width="40">
                                        </div>
                                        <select class="form-select form-select-solid py-2" aria-label="Select example">
                                            <option>Open this select menu</option>
                                        </select>
                                        <div class="input-group mb-5">
                                            <input type="text" class="form-control my-3"
                                                aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-default" placeholder="search" />
                                        </div>
                                    </div>

                                    <nav class="flex-1 w-full">
                                        @foreach ($navItems as $link)
                                            <a href="{{ $link['href'] }}"
                                                class="w-full group px-3 flex items-center justify-start lg:justify-start xl:justify-start text-sm font-medium rounded-md cursor-pointer font-medium opacity-70 hover:opacity-100 py-2 md:py-2"
                                                id="{{ $link['id'] }}"
                                                exact-path-active-class="exact-path-active-class"
                                                meta="{{ $link['meta'] }}">
                                                <img src="{{ $link['img_src'] }}"
                                                    class="md:mr-0 h-5 w-5 mr-2 lg:mr-2 xl:mr-2">
                                                <span
                                                    class="hl_text-overflow sm:hidden md:hidden nav-title lg:block xl:block">{{ $link['title'] }}</span>
                                            </a>
                                        @endforeach
                                    </nav>
                                </div>
                            </div>
                        </div>


                        {{-- stats cards customizations --}}
                        <div class="row mt-5">
                            <div class="col-md-8">
                                <div class="card-customizer customizer-main">
                                    <h1>Cards Customizer</h1>
                                    <div>
                                        <label for="cardfontSize">Font Size</label>
                                        <input type="text" id="cardfontSize" name="cardfontSize"
                                            placeholder="e.g., 16px"
                                            value="{{ isset($css_json['cardfontSize']) ? $css_json['cardfontSize'] : '' }}"
                                            oninput="applyStylesCard()">
                                    </div>
                                    <div>
                                        <label for="cardfontColor">Font Color</label>
                                        <input type="radio" id="cardfontColorCodeRadio" name="cardfontColorType"
                                            value="code"
                                            {{ isset($css_json['cardfontColorType']) && $css_json['cardfontColorType'] == 'code' ? 'checked' : '' }}
                                            onclick="toggleColorInput('cardfontColor')"> Code
                                        <input type="radio" id="cardfontColorPickerRadio" name="cardfontColorType"
                                            value="picker"
                                            {{ isset($css_json['cardfontColorType']) && $css_json['cardfontColorType'] == 'picker' ? 'checked' : '' }}
                                            onclick="toggleColorInput('cardfontColor')"> Picker
                                        <input type="text" id="cardfontColorCode" name="cardfontColor"
                                            placeholder="e.g., #000000"
                                            value="{{ isset($css_json['cardfontColor']) && $css_json['cardfontColorType'] == 'code' ? $css_json['cardfontColor'] : '' }}"
                                            style="{{ !isset($css_json['cardfontColorType']) || $css_json['cardfontColorType'] != 'code' ? 'display:none;' : '' }}"
                                            oninput="applyStylesCard()">
                                             <br>
                                        <input type="color" id="cardfontColorPicker" name="cardfontColor"
                                            value="{{ isset($css_json['cardfontColor']) && $css_json['cardfontColorType'] == 'picker' ? $css_json['cardfontColor'] : '' }}"
                                            style="{{ !isset($css_json['cardfontColorType']) || $css_json['cardfontColorType'] != 'picker' ? 'display:none;' : '' }}"
                                            oninput="applyStylesCard()">
                                    </div>
                                    <div>
                                        <label for="cardbgColor">Background Color</label>
                                        <input type="radio" id="cardbgColorCodeRadio" name="cardbgColorType"
                                            value="code"
                                            {{ isset($css_json['cardbgColorType']) && $css_json['cardbgColorType'] == 'code' ? 'checked' : '' }}
                                            onclick="toggleColorInput('cardbgColor')"> Code
                                        <input type="radio" id="cardbgColorPickerRadio" name="cardbgColorType"
                                            value="picker"
                                            {{ isset($css_json['cardbgColorType']) && $css_json['cardbgColorType'] == 'picker' ? 'checked' : '' }}
                                            onclick="toggleColorInput('cardbgColor')"> Picker
                                        <input type="radio" id="cardbgGradientRadio" name="cardbgColorType"
                                            value="gradient"
                                            {{ isset($css_json['cardbgColorType']) && $css_json['cardbgColorType'] == 'gradient' ? 'checked' : '' }}
                                            onclick="toggleColorInput('cardbgColor')"> Gradient
                                        <input type="text" id="cardbgColorCode" name="cardbgColor"
                                            placeholder="e.g., #ffffff"
                                            value="{{ isset($css_json['cardbgColor']) && $css_json['cardbgColorType'] == 'code' ? $css_json['cardbgColor'] : '' }}"
                                            style="{{ !isset($css_json['cardbgColorType']) || $css_json['cardbgColorType'] != 'code' ? 'display:none;' : '' }}"
                                            oninput="applyStylesCard()">
                                             <br>
                                        <input type="color" id="cardbgColorPicker" name="cardbgColor"
                                            value="{{ isset($css_json['cardbgColor']) && $css_json['cardbgColorType'] == 'picker' ? $css_json['cardbgColor'] : '' }}"
                                            style="{{ !isset($css_json['cardbgColorType']) || $css_json['cardbgColorType'] != 'picker' ? 'display:none;' : '' }}"
                                            oninput="applyStylesCard()">
                                        <div id="cardbgGradientContainer"
                                            style="{{ !isset($css_json['cardbgColorType']) || $css_json['cardbgColorType'] != 'gradient' ? 'display:none;' : '' }}">
                                            <select id="cardbgGradientType" onchange="applyStylesCard()">
                                                <option value="to right"
                                                    {{ isset($css_json['cardbgGradientType']) && $css_json['cardbgGradientType'] == 'to right' ? 'selected' : '' }}>
                                                    To Right</option>
                                                <option value="to left"
                                                    {{ isset($css_json['cardbgGradientType']) && $css_json['cardbgGradientType'] == 'to left' ? 'selected' : '' }}>
                                                    To Left</option>
                                                <option value="to top"
                                                    {{ isset($css_json['cardbgGradientType']) && $css_json['cardbgGradientType'] == 'to top' ? 'selected' : '' }}>
                                                    To Top</option>
                                                <option value="to bottom"
                                                    {{ isset($css_json['cardbgGradientType']) && $css_json['cardbgGradientType'] == 'to bottom' ? 'selected' : '' }}>
                                                    To Bottom</option>
                                            </select>
                                            <div id="cardbgGradientColors" class="gr-colors">
                                                @if (isset($css_json['cardbgGradientColors']) && is_array($css_json['cardbgGradientColors']))
                                                    @foreach ($css_json['cardbgGradientColors'] as $index => $color)
                                                        <div class="gradient-color-row">
                                                            <label for="cardbgGradientColor{{ $index + 1 }}">Color
                                                                {{ $index + 1 }}:</label>
                                                            <input type="color"
                                                                id="cardbgGradientColor{{ $index + 1 }}"
                                                                class="cardbgGradientColor" value="{{ $color }}"
                                                                oninput="applyStylesCard()">
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <button type="button" onclick="addGradientColorCard()">Add Color</button>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="cardBoxShadow">Box Shadow</label>
                                        <input type="text" id="cardBoxShadow" name="cardBoxShadow"
                                            placeholder="e.g., box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;"
                                            value="{{ isset($css_json['cardBoxShadow']) ? $css_json['cardBoxShadow'] : '' }}"
                                            oninput="applyStylesCard()">
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="chart-container grid-stack-item-content " id="chart-container">
                                    <div class="card card-stretch-33 card-bordered mb-5 hl-card">
                                        <div class="card-header hl-card-header">
                                            <h3 class="card-title">Total Unread Conversations</h3>
                                        </div>
                                        <div class="card-body hl-card-content">
                                            99
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- chart inner customizations --}}
                        <div class="row mt-5">
                            <div class="col-md-8">
                                <div class="chart-customizer customizer-main">
                                    <h1>Charts Customizer</h1>
                                    <!-- Inner Text Font Size -->
                                    <div>
                                        <label for="innerTextFontSize">Inner Text Font Size</label>
                                        <input type="text" id="innerTextFontSize" name="innerTextFontSize"
                                            value="{{ isset($css_json['innerTextFontSize']) ? $css_json['innerTextFontSize'] : '' }}"
                                            placeholder="e.g., 24px" oninput="applyStylesChart()">
                                    </div>
                                    <!-- Labels/Legends Font Size -->
                                    <div>
                                        <label for="labelsFontSize">Labels/Legends Font Size</label>
                                        <input type="text" id="labelsFontSize" name="labelsFontSize"
                                            value="{{ isset($css_json['labelsFontSize']) ? $css_json['labelsFontSize'] : '' }}"
                                            placeholder="e.g., 12px" oninput="applyStylesChart()">
                                    </div>
                                    <!-- Labels/Legends Font Color -->
                                    <div>
                                        <label for="labelsFontColor">Labels/Legends Font Color</label>
                                        <input type="radio" id="labelsFontColorCodeRadio" name="labelsFontColorType"
                                            value="code" onclick="toggleColorInput('labelsFontColor')"
                                            {{ isset($css_json['labelsFontColorType']) && $css_json['labelsFontColorType'] == 'code' ? 'checked' : '' }}>
                                        Code

                                        <input type="radio" id="labelsFontColorPickerRadio" name="labelsFontColorType"
                                            value="picker" onclick="toggleColorInput('labelsFontColor')"
                                            {{ isset($css_json['labelsFontColorType']) && $css_json['labelsFontColorType'] == 'picker' ? 'checked' : '' }}>
                                        Picker

                                        <input type="text" id="labelsFontColorCode" name="labelsFontColor"
                                            placeholder="e.g., #000000" oninput="applyStylesChart()"
                                            value="{{ isset($css_json['labelsFontColorType']) && $css_json['labelsFontColorType'] == 'code' ? $css_json['labelsFontColor'] : '' }}">
                                             <br>
                                        <input type="color" id="labelsFontColorPicker" name="labelsFontColor"
                                            style="display:none;" oninput="applyStylesChart()"
                                            value="{{ isset($css_json['labelsFontColorType']) && $css_json['labelsFontColorType'] == 'picker' ? $css_json['labelsFontColor'] : '' }}">

                                    </div>




                                    <!-- Path Fill Color -->
                                    <div>
                                        <label for="chartFillColor">Path Fill Color</label>
                                        <input type="radio" id="chartFillColorCodeRadio" name="chartFillColorType"
                                            value="code" checked onclick="toggleColorInput('chartFillColor')"
                                            {{ $css_json['chartFillColorType'] == 'code' ? 'checked' : '' }}> Code
                                        <input type="radio" id="chartFillColorPickerRadio" name="chartFillColorType"
                                            value="picker" onclick="toggleColorInput('chartFillColor')"
                                            {{ $css_json['chartFillColorType'] == 'picker' ? 'checked' : '' }}> Picker
                                        <input type="text" id="chartFillColorCode" name="chartFillColor"
                                            placeholder="e.g., #0000FF" oninput="applyStylesChart()"
                                            value="{{ $css_json['chartFillColorType'] == 'code' ? $css_json['chartFillColor'] : '' }}">
                                             <br>
                                        <input type="color" id="chartFillColorPicker" name="chartFillColor"
                                            style="display:none;" oninput="applyStylesChart()"
                                            value="{{ $css_json['chartFillColorType'] == 'picker' ? $css_json['chartFillColor'] : '' }}">
                                    </div>
                                    <!-- Path Stroke Color -->
                                    <div>
                                        <label for="chartStrokeColor">Path Stroke Color</label>
                                        <input type="radio" id="chartStrokeColorCodeRadio" name="chartStrokeColorType"
                                            value="code" checked onclick="toggleColorInput('chartStrokeColor')"
                                            {{ $css_json['chartStrokeColorType'] == 'code' ? 'checked' : '' }}> Code
                                        <input type="radio" id="chartStrokeColorPickerRadio"
                                            name="chartStrokeColorType" value="picker"
                                            onclick="toggleColorInput('chartStrokeColor')"
                                            {{ $css_json['chartStrokeColorType'] == 'picker' ? 'checked' : '' }}> Picker
                                        <input type="text" id="chartStrokeColorCode" name="chartStrokeColor"
                                            placeholder="e.g., #FF0000" oninput="applyStylesChart()"
                                            value="{{ $css_json['chartStrokeColorType'] == 'code' ? $css_json['chartStrokeColor'] : '' }}">
                                             <br>
                                        <input type="color" id="chartStrokeColorPicker" name="chartStrokeColor"
                                            style="display:none;" oninput="applyStylesChart()"
                                            value="{{ $css_json['chartStrokeColorType'] == 'picker' ? $css_json['chartStrokeColor'] : '' }}">
                                    </div>


                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="inner-chart-container grid-stack-item-content ">
                                    <div class="card card-stretch-33 card-bordered mb-5 hl-card">
                                        <div class="card-header hl-card-header">
                                            <h3 class="card-title">Appointment Counts by Status</h3>
                                        </div>
                                        <div class="card-body hl-card-content">
                                            <div class="vue-echarts-inner" _echarts_instance_="ec_1721453620544">
                                                <div
                                                    style="position: relative; overflow: hidden; width: 443px; height: 276px; cursor: default;">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                        baseProfile="full" width="443" height="276"
                                                        style="position: absolute; left: 0px; top: 0px; user-select: none;">
                                                        <rect width="443" height="276" x="0" y="0" fill="none">
                                                        </rect>
                                                        <g>
                                                            <path
                                                                d="M110.75 60.9598A4 4 0 0 1 114.9574 56.9652A81.144 81.144 0 1 1 29.7152 142.2074A4 4 0 0 1 33.7098 138L43.1122 138A4 4 0 0 1 47.1052 141.7639A63.756 63.756 0 1 0 114.5139 74.3552A4 4 0 0 1 110.75 70.3622Z"
                                                                fill="#53B1FD" stroke="#fff" stroke-width="2"
                                                                stroke-linejoin="round"></path>
                                                            <path
                                                                d="M33.7098 138A4 4 0 0 1 29.7152 133.7926A81.144 81.144 0 0 1 106.5426 56.9652A4 4 0 0 1 110.75 60.9598L110.75 70.3622A4 4 0 0 1 106.9861 74.3552A63.756 63.756 0 0 0 47.1052 134.2361A4 4 0 0 1 43.1122 138Z"
                                                                fill="#22CCEE" stroke="#fff" stroke-width="2"
                                                                stroke-linejoin="round"></path>
                                                            <path d="M-7.8494 -12l15.6989 0l0 24l-15.6989 0Z"
                                                                transform="translate(110.75 138)" fill="transparent">
                                                            </path><text dominant-baseline="central" text-anchor="middle"
                                                                transform="translate(110.75 138)" fill="#101828"
                                                                style="font-size: 24px; font-family: Inter; font-weight: 500;">4</text>
                                                            <path d="M-5 -5l120.3295 0l0 56l-120.3295 0Z"
                                                                transform="translate(261.2205 115)" fill="rgb(0,0,0)"
                                                                fill-opacity="0" stroke="#ccc" stroke-width="0"></path>
                                                            <path
                                                                d="M3.5 0L21.5 0A3.5 3.5 0 0 1 25 3.5L25 10.5A3.5 3.5 0 0 1 21.5 14L3.5 14A3.5 3.5 0 0 1 0 10.5L0 3.5A3.5 3.5 0 0 1 3.5 0"
                                                                transform="translate(262.2205 117)" fill="#53B1FD"
                                                                stroke="#fff" stroke-width="2" stroke-linecap="butt"
                                                                stroke-miterlimit="10" stroke-linejoin="round"></path>
                                                            <path d="M30 -2l79.3295 0l0 18l-79.3295 0Z"
                                                                transform="translate(262.2205 117)" fill="transparent">
                                                            </path><text dominant-baseline="central" text-anchor="start"
                                                                xml:space="preserve" x="30" y="7"
                                                                transform="translate(262.2205 117)" fill="#333"
                                                                style="font-size: 12px; font-family: Inter; font-weight: 400;">Confirmed
                                                                - 3</text>
                                                            <path d="M-1 -2l110.3295 0l0 18l-110.3295 0Z"
                                                                transform="translate(262.2205 117)" fill="transparent">
                                                            </path>
                                                            <path
                                                                d="M3.5 0L21.5 0A3.5 3.5 0 0 1 25 3.5L25 10.5A3.5 3.5 0 0 1 21.5 14L3.5 14A3.5 3.5 0 0 1 0 10.5L0 3.5A3.5 3.5 0 0 1 3.5 0"
                                                                transform="translate(262.2205 145)" fill="#22CCEE"
                                                                stroke="#fff" stroke-width="2" stroke-linecap="butt"
                                                                stroke-miterlimit="10" stroke-linejoin="round"></path>
                                                            <path d="M30 -2l63.4943 0l0 18l-63.4943 0Z"
                                                                transform="translate(262.2205 145)" fill="transparent">
                                                            </path><text dominant-baseline="central" text-anchor="start"
                                                                xml:space="preserve" x="30" y="7"
                                                                transform="translate(262.2205 145)" fill="#333"
                                                                style="font-size: 12px; font-family: Inter; font-weight: 400;">Showed
                                                                - 1</text>
                                                            <path d="M-1 -2l94.4943 0l0 18l-94.4943 0Z"
                                                                transform="translate(262.2205 145)" fill="transparent">
                                                            </path>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class=""></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-5">
                            <div class="customizer-main">
                                <h1>Custom CSS</h1>
                                <textarea name="customCSS" id="customCSS" cols="30" rows="10" placeholder="#id{ color : red;}"
                                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"></textarea>
                            </div>
                        </div>

                         <div class="copy-btn text-right mt-5">
            <button type="button" class="btn btn-success" onclick="copyCSS()">Copy CSS</button>
            <input type="submit" value="Save CSS" class="btn btn-primary save-css-btn" form="customizerForm">
        </div>

                    </div>

                </div>



            </form>
        </div>

       

    </div>
    </div>


@endsection
@section('js')
    <script>
        var finalCSS = '';

        function toggleColorInput(id) {
            console.log(id);
            const codeInput = document.getElementById(`${id}Code`);
            const pickerInput = document.getElementById(`${id}Picker`);
            const codeRadio = document.getElementById(`${id}CodeRadio`);
            const pickerRadio = document.getElementById(`${id}PickerRadio`);
            let attach = '';
            if (id.includes('card')) {
                attach = 'card';
            } else if (id.includes('global')) {
                attach = 'global';
            }


            const gradientContainer = document.getElementById(`${attach}bgGradientContainer`);
            const gradientRadio = document.getElementById(`${attach}bgGradientRadio`);

            if (codeRadio && codeRadio.checked) {
                codeInput.style.display = 'block';
                pickerInput.style.display = 'none';
                gradientContainer.style.display = 'none';
            } else if (pickerRadio && pickerRadio.checked) {
                codeInput.style.display = 'none';
                pickerInput.style.display = 'block';
                gradientContainer.style.display = 'none';
            } else if (gradientRadio && gradientRadio.checked) {
                codeInput.style.display = 'none';
                pickerInput.style.display = 'none';
                gradientContainer.style.display = 'block';
            }
            applyStyles();
        }


        function addGradientColor() {
            const gradientColors = document.getElementById('bgGradientColors');
            const newColorInput = document.createElement('div');
            newColorInput.className = 'gradient-color-row';
            newColorInput.innerHTML = `
                <label for="bgGradientColor${gradientColors.children.length + 1}">Color ${gradientColors.children.length + 1}:</label>
                <input type="color" id="bgGradientColor${gradientColors.children.length + 1}" class="bgGradientColor" oninput="applyStyles()">
            `;
            gradientColors.appendChild(newColorInput);
            applyStyles();
        }


        function addGradientColorCard() {
            const gradientColors = document.getElementById('cardbgGradientColors');
            const newColorInput = document.createElement('div');
            newColorInput.className = 'gradient-color-row';
            newColorInput.innerHTML = `
                <label for="cardbgGradientColor${gradientColors.children.length + 1}">Color ${gradientColors.children.length + 1}:</label>
                <input type="color" id="cardbgGradientColor${gradientColors.children.length + 1}" class="cardbgGradientColor" oninput="applyStylesCard()">
            `;
            gradientColors.appendChild(newColorInput);
            applyStylesCard();
        }

        function addGradientColorGlobal() {
            const gradientColors = document.getElementById('globalbgGradientColors');
            const newColorInput = document.createElement('div');
            newColorInput.className = 'gradient-color-row';
            newColorInput.innerHTML = `
                <label for="globalbgGradientColor${gradientColors.children.length + 1}">Color ${gradientColors.children.length + 1}:</label>
                <input type="color" id="globalbgGradientColor${gradientColors.children.length + 1}" class="globalbgGradientColor" oninput="applyStylesGlobal()">
            `;
            gradientColors.appendChild(newColorInput);
            applyStylesGlobal();
        }


        function applyStylesGlobal() {
            const globalfontSize = document.getElementById('globalfontSize').value;
            const globalfontColor = document.querySelector('input[name="globalfontColorType"]:checked').value === 'code' ?
                document
                .getElementById('globalfontColorCode').value : document.getElementById('globalfontColorPicker').value;
            const globalbgColorType = document.querySelector('input[name="globalbgColorType"]:checked').value;
            const globalbgGradientType = document.getElementById('globalbgGradientType').value;
            const globalbgGradientColors = document.querySelectorAll('.globalbgGradientColor');
            const globalfontFamily = document.getElementById('globalfontFamily').value;

            console.log(globalbgColorType);

            let globalbgGradient = '';

            if (globalbgColorType === 'code' || globalbgColorType === 'picker') {
                const globalbgColor = globalbgColorType === 'code' ? document.getElementById('globalbgColorCode').value :
                    document
                    .getElementById('globalbgColorPicker').value;
                document.querySelector('body').style.backgroundColor = globalbgColor;
                document.querySelector('body').style.backgroundImage = 'none';
            } else if (globalbgColorType === 'gradient') {
                globalbgGradient = `linear-gradient(${globalbgGradientType}, `;
                globalbgGradientColors.forEach((color, index) => {
                    if (index !== 0) globalbgGradient += ', ';
                    globalbgGradient += color.value;
                });
                globalbgGradient += ')';
                document.querySelector('body').style.backgroundImage = globalbgGradient;
                document.querySelector('body').style.backgroundColor = 'transparent'; // Reset background color
            }

            document.querySelector('body').style.fontSize = globalfontSize;
            document.querySelector('body').style.color = globalfontColor;
            document.querySelector('body').style.fontFamily = globalfontFamily;
        }


        function applyStyles() {
            const fontSize = document.getElementById('fontSize').value;
            const fontColor = document.querySelector('input[name="fontColorType"]:checked').value === 'code' ? document
                .getElementById('fontColorCode').value : document.getElementById('fontColorPicker').value;
            const bgColorType = document.querySelector('input[name="bgColorType"]:checked').value;
            const bgGradientType = document.getElementById('bgGradientType').value;
            const bgGradientColors = document.querySelectorAll('.bgGradientColor');
            const fontFamily = document.getElementById('fontFamily').value;
            const hoverBgColor = document.querySelector('input[name="hoverBgColorType"]:checked').value === 'code' ?
                document.getElementById('hoverBgColorCode').value : document.getElementById('hoverBgColorPicker').value;
            const padding = document.getElementById('padding').value;
            const margin = document.getElementById('margin').value;

            let bgGradient = '';

            if (bgColorType === 'code' || bgColorType === 'picker') {
                const bgColor = bgColorType === 'code' ? document.getElementById('bgColorCode').value : document
                    .getElementById('bgColorPicker').value;
                document.querySelector('#sidebar-v2').style.backgroundColor = bgColor;
                document.querySelector('#sidebar-v2').style.backgroundImage = 'none';
            } else if (bgColorType === 'gradient') {
                bgGradient = `linear-gradient(${bgGradientType}, `;
                bgGradientColors.forEach((color, index) => {
                    if (index !== 0) bgGradient += ', ';
                    bgGradient += color.value;
                });
                bgGradient += ')';
                document.querySelector('#sidebar-v2').style.backgroundImage = bgGradient;
                document.querySelector('#sidebar-v2').style.backgroundColor = 'transparent'; // Reset background color
            }

            const links = document.querySelectorAll('#sidebar-v2 nav a');
            links.forEach(link => {
                if (fontSize) link.style.fontSize = fontSize;
                if (fontColor) link.style.color = fontColor;
                if (fontFamily) link.style.fontFamily = fontFamily;
                if (padding) link.style.padding = padding;
                if (margin) link.style.margin = margin;

                link.onmouseover = () => {
                    link.style.backgroundColor = hoverBgColor;
                    link.style.color = '#fff';
                };

                link.onmouseout = () => {
                    link.style.backgroundColor = 'transparent';
                    link.style.color = fontColor;
                };

            });
        }

        function applyStylesCard() {
            const fontSize = document.getElementById('cardfontSize').value;
            const fontColor = document.querySelector('input[name="cardfontColorType"]:checked').value === 'code' ? document
                .getElementById('cardfontColorCode').value : document.getElementById('cardfontColorPicker').value;
            const bgColorType = document.querySelector('input[name="cardbgColorType"]:checked').value;
            const bgGradientType = document.getElementById('cardbgGradientType').value;
            const bgGradientColors = document.querySelectorAll('.cardbgGradientColor');
            const fontFamily = document.getElementById('fontFamily').value;
            const hoverBgColor = document.querySelector('input[name="hoverBgColorType"]:checked').value === 'code' ?
                document.getElementById('hoverBgColorCode').value : document.getElementById('hoverBgColorPicker').value;
            const padding = document.getElementById('padding').value;
            const margin = document.getElementById('margin').value;

            //box shadow
            const cardBoxShadow = document.getElementById('cardBoxShadow').value;

            let bgGradient = '';

            if (bgColorType === 'code' || bgColorType === 'picker') {
                const bgColor = bgColorType === 'code' ? document.getElementById('cardbgColorCode').value : document
                    .getElementById('cardbgColorPicker').value;
                document.querySelector('.chart-container .hl-card').style.backgroundColor = bgColor;
                document.querySelector('.chart-container .hl-card').style.backgroundImage = 'none';
            } else if (bgColorType === 'gradient') {
                bgGradient = `linear-gradient(${bgGradientType}, `;
                bgGradientColors.forEach((color, index) => {
                    if (index !== 0) bgGradient += ', ';
                    bgGradient += color.value;
                });
                bgGradient += ')';
                document.querySelector('.chart-container .hl-card').style.backgroundImage = bgGradient;
                document.querySelector('.chart-container .hl-card').style.backgroundColor =
                    'transparent'; // Reset background color
            }


            console.log(cardBoxShadow);
            if (cardBoxShadow) {
                document.querySelector('.chart-container .hl-card').style.boxShadow = cardBoxShadow;
            } else {
                document.querySelector('.chart-container .hl-card').style.boxShadow = 'none';
            }

            const hl_card_head = document.querySelector('.chart-container .hl-card-header h3');
            const hl_card_content = document.querySelector('.chart-container .hl-card-content');

            //apply styles on it
            if (fontSize) hl_card_head.style.fontSize = fontSize;
            if (fontColor) hl_card_head.style.color = fontColor;
            if (fontFamily) hl_card_head.style.fontFamily = fontFamily;
            if (padding) hl_card_head.style.padding = padding;
            if (margin) hl_card_head.style.margin = margin;

            if (fontSize) hl_card_content.style.fontSize = fontSize;
            if (fontColor) hl_card_content.style.color = fontColor;
            if (fontFamily) hl_card_content.style.fontFamily = fontFamily;
            if (padding) hl_card_content.style.padding = padding;
            if (margin) hl_card_content.style.margin = margin;

            hl_card_head.onmouseover = () => {
                hl_card_head.style.backgroundColor = hoverBgColor;
                hl_card_head.style.color = '#fff';
            };

            hl_card_head.onmouseout = () => {
                hl_card_head.style.backgroundColor = 'transparent';
                hl_card_head.style.color = fontColor;
            };

        }



        function applyStylesChart() {
            // Inner Text Font Size
            const innerTextFontSize = document.getElementById('innerTextFontSize').value;
            if (innerTextFontSize) {
                document.querySelectorAll('.vue-echarts-inner svg text').forEach(text => {
                    if (text.innerHTML.trim() === '4') { // Assuming the inner text to be "4"
                        text.style.fontSize = innerTextFontSize;
                    }
                });
            }

            // Labels/Legends Font Size
            const labelsFontSize = document.getElementById('labelsFontSize').value;
            if (labelsFontSize) {
                document.querySelectorAll('.vue-echarts-inner svg text').forEach(text => {
                    if (text.innerHTML.trim() !== '4') { // Assuming the inner text to be "4"
                        text.style.fontSize = labelsFontSize;
                    }
                });
            }

            // Labels/Legends Font Color
            const labelsFontColor = document.getElementById('labelsFontColorCodeRadio').checked ? document.getElementById(
                'labelsFontColorCode').value : document.getElementById('labelsFontColorPicker').value;
            if (labelsFontColor) {
                document.querySelectorAll('.vue-echarts-inner svg text').forEach(text => {
                    if (text.innerHTML.trim() !== '4') { // Assuming the inner text to be "4"
                        text.style.fill = labelsFontColor;
                    }
                });
            }

            // Path Fill Color and Stroke Color for Main Chart
            const chartFillColor = document.getElementById('chartFillColorCodeRadio').checked ? document.getElementById(
                'chartFillColorCode').value : document.getElementById('chartFillColorPicker').value;
            const chartStrokeColor = document.getElementById('chartStrokeColorCodeRadio').checked ? document.getElementById(
                'chartStrokeColorCode').value : document.getElementById('chartStrokeColorPicker').value;

            if (chartFillColor || chartStrokeColor) {
                // Select only the first two paths to change their colors
                // document.querySelectorAll('.vue-echarts-inner svg path:nth-of-type(1), .vue-echarts-inner svg path:nth-of-type(2)').forEach((path, index) => {
                //     if (chartFillColor) path.style.fill = chartFillColor;
                //     if (chartStrokeColor) path.style.stroke = chartStrokeColor;
                // });

                let targetPaths = document.querySelectorAll('.vue-echarts-inner svg path');
                targetPaths.forEach((path, index) => {
                    //if path has attributes stroke and stroke-width, then it is a main chart path
                    if (path.getAttribute('stroke') && path.getAttribute('stroke-width')) {
                        if (chartFillColor) path.style.fill = chartFillColor;
                        if (chartStrokeColor) path.style.stroke = chartStrokeColor;
                    }
                });

            }

            // Chart Size
            // const chartSize = document.getElementById('chartSize').value;
            // if (chartSize) {
            //     const svgElement = document.querySelector('.vue-echarts-inner svg');
            //     svgElement.setAttribute('width', chartSize);
            //     svgElement.setAttribute('height', chartSize);
            // }
        }

        function copyCSS(makealert = true) {
            const fontSize = document.getElementById('fontSize').value;
            const fontColor = document.querySelector('input[name="fontColorType"]:checked').value === 'code' ? document
                .getElementById('fontColorCode').value : document.getElementById('fontColorPicker').value;
            const bgColorType = document.querySelector('input[name="bgColorType"]:checked').value;
            const bgGradientType = document.getElementById('bgGradientType').value;
            const bgGradientColors = document.querySelectorAll('.bgGradientColor');
            let bgGradient = '';

            if (bgColorType === 'code') {
                const bgColor = document.getElementById('bgColorCode').value;
                document.querySelector('#sidebar-v2').style.backgroundColor = bgColor + ' !important';
            } else if (bgColorType === 'picker') {
                const bgColor = document.getElementById('bgColorPicker').value;
                document.querySelector('#sidebar-v2').style.backgroundColor = bgColor + ' !important';
            } else if (bgColorType === 'gradient') {
                bgGradient = `linear-gradient(${bgGradientType}, `;
                bgGradientColors.forEach((color, index) => {
                    if (index !== 0) bgGradient += ', ';
                    bgGradient += color.value;
                });
                bgGradient += ')';
                document.querySelector('#sidebar-v2').style.backgroundImage = bgGradient + ' !important';
            }

            const fontFamily = document.getElementById('fontFamily').value;
            const hoverBgColor = document.querySelector('input[name="hoverBgColorType"]:checked').value === 'code' ?
                document.getElementById('hoverBgColorCode').value : document.getElementById('hoverBgColorPicker').value;
            const padding = document.getElementById('padding').value;
            const margin = document.getElementById('margin').value;

            let css = `#sidebar-v2 {\n`;
            if (bgColorType === 'code') css +=
                `  background-color: ${document.getElementById('bgColorCode').value} !important;\n`;
            if (bgColorType === 'picker') css +=
                `  background-color: ${document.getElementById('bgColorPicker').value} !important;\n`;
            if (bgColorType === 'gradient') css += `  background-image: ${bgGradient} !important;\n`;
            css += `}\n`;

            css += `#sidebar-v2 nav a .nav-title {\n`;
            if (fontSize) css += `  font-size: ${fontSize} !important ;\n`;
            if (fontColor) css += `  color: ${fontColor} !important;\n`;
            if (fontFamily) css += `  font-family: ${fontFamily} !important;\n`;
            if (padding) css += `  padding: ${padding} !important;\n`;
            if (margin) css += `  margin: ${margin} !important;\n`;
            css += `}\n\n`;

            css += `#sidebar-v2 nav a:hover {\n`;
            css += `  background-color: ${hoverBgColor} !important;\n`;
            css += ` color: ${fontColor} !important;\n`;
            css += `}\n`;

            //active link
            css += `#sidebar-v2 nav a.active{\n`;
            css += `  background-color: ${hoverBgColor} !important;\n`;
            css += ` color: ${fontColor} !important;\n`;
            css += `}\n`;

            css += `#sidebar-v2 nav a.active .nav-title{\n`;
            css += ` color: ${fontColor} !important;\n`;
            css += `}\n`;


            // cards css
            const cardfontSize = document.getElementById('cardfontSize').value;
            const cardfontColor = document.querySelector('input[name="cardfontColorType"]:checked').value === 'code' ?
                document
                .getElementById('cardfontColorCode').value : document.getElementById('cardfontColorPicker').value;
            const cardbgColorType = document.querySelector('input[name="cardbgColorType"]:checked').value;
            const cardbgGradientType = document.getElementById('cardbgGradientType').value;
            const cardbgGradientColors = document.querySelectorAll('.cardbgGradientColor');
            let cardbgGradient = '';

            if (cardbgColorType === 'code') {
                const cardbgColor = document.getElementById('cardbgColorCode').value;
                document.querySelector('.grid-stack-item-content .hl-card').style.backgroundColor = cardbgColor;
            } else if (cardbgColorType === 'picker') {
                const cardbgColor = document.getElementById('cardbgColorPicker').value;
                document.querySelector('.grid-stack-item-content .hl-card').style.backgroundColor = cardbgColor;
            } else if (cardbgColorType === 'gradient') {
                cardbgGradient = `linear-gradient(${cardbgGradientType}, `;
                cardbgGradientColors.forEach((color, index) => {
                    if (index !== 0) cardbgGradient += ', ';
                    cardbgGradient += color.value;
                });
                cardbgGradient += ')';
                document.querySelector('.grid-stack-item-content .hl-card').style.backgroundImage = cardbgGradient;
            }

            // const cardfontFamily = document.getElementById('fontFamily').value;

            const cardhoverBgColor = document.querySelector('input[name="hoverBgColorType"]:checked').value === 'code' ?
                document.getElementById('hoverBgColorCode').value : document.getElementById('hoverBgColorPicker').value;

            const cardpadding = document.getElementById('padding').value;
            const cardmargin = document.getElementById('margin').value;

            css += `.grid-stack-item-content .hl-card {\n`;
            if (cardbgColorType === 'code') css +=
                `  background-color: ${document.getElementById('cardbgColorCode').value} !important;\n`;
            if (cardbgColorType === 'picker') css +=
                `  background-color: ${document.getElementById('cardbgColorPicker').value} !important;\n`;
            if (cardbgColorType === 'gradient') css += `  background-image: ${cardbgGradient} !important;\n`;
            css += `}\n`;

            css += `.grid-stack-item-content .hl-card-header {\n`;
            if (cardfontSize) css += `  font-size: ${cardfontSize} !important ;\n`;
            if (cardfontColor) css += `  color: ${cardfontColor} !important;\n`;
            // if (cardfontFamily) css += `  font-family: ${cardfontFamily} !important;\n`;
            if (cardpadding) css += `  padding: ${cardpadding} !important;\n`;
            if (cardmargin) css += `  margin: ${cardmargin} !important;\n`;
            css += `}\n\n`;

            css += `.grid-stack-item-content .hl-text-md-medium {\n`;
            if (cardfontSize) css += `  font-size: ${cardfontSize} !important;\n`;
            if (cardfontColor) css += `  color: ${cardfontColor} !important;\n`;
            // if (cardfontFamily) css += `  font-family: ${cardfontFamily} !important;\n`;
            css += `}\n\n`;

            css += `.grid-stack-item-content .hl-card-content {\n`;
            if (cardfontSize) css += `  font-size: ${cardfontSize} !important ;\n`;
            if (cardfontColor) css += `  color: ${cardfontColor} !important;\n`;
            // if (cardfontFamily) css += `  font-family: ${cardfontFamily} !important;\n`;
            if (cardpadding) css += `  padding: ${cardpadding} !important;\n`;
            if (cardmargin) css += `  margin: ${cardmargin} !important;\n`;
            css += `}\n\n`;

            // location-dashboard-numeric-chart-text its an svg 
            // document.querySelectorAll('.location-dashboard-numeric-chart-text').forEach((element) => {
            //     element.classList.remove('fill-gray-800');
            // });

            css += `.location-dashboard-numeric-chart-text text {\n`;
            if (cardfontSize) css += `  font-size: ${cardfontSize} !important ;\n`;
            if (cardfontColor) css += `  fill: ${cardfontColor} !important;\n`;
            css += `}\n\n`;



            css += `.location-dashboard-numeric-chart-text:hover {\n`;
            css += `  background-color: transparent !important;\n`;
            css += `  color: #fff !important;\n`;
            css += `}\n`;


            // charts css
            const innerTextFontSize = document.getElementById('innerTextFontSize').value;
            const labelsFontSize = document.getElementById('labelsFontSize').value;
            const labelsFontColor = document.getElementById('labelsFontColorCodeRadio').checked ? document.getElementById(
                'labelsFontColorCode').value : document.getElementById('labelsFontColorPicker').value;
            const chartFillColor = document.getElementById('chartFillColorCodeRadio').checked ? document.getElementById(
                'chartFillColorCode').value : document.getElementById('chartFillColorPicker').value;
            const chartStrokeColor = document.getElementById('chartStrokeColorCodeRadio').checked ? document.getElementById(
                'chartStrokeColorCode').value : document.getElementById('chartStrokeColorPicker').value;


            css += `.vue-echarts-inner svg text {\n`;
            if (innerTextFontSize) css += `  font-size: ${innerTextFontSize} !important ;\n`;
            if (labelsFontSize) css += `  font-size: ${labelsFontSize} !important ;\n`;
            if (labelsFontColor) css += `  fill: ${labelsFontColor} !important;\n`;
            css += `}\n\n`;

            css += `.vue-echarts-inner svg path[stroke][stroke-width] {\n`;
            if (chartFillColor) css += `  fill: ${chartFillColor} !important;\n`;
            if (chartStrokeColor) css += `  stroke: ${chartStrokeColor} !important;\n`;
            css += `}\n\n`;

            css += `.vue-echarts-inner svg path:not([transform]) {\n`;
            if (chartFillColor) css += `  fill: ${chartFillColor} !important;\n`;
            if (chartStrokeColor) css += `  stroke: ${chartStrokeColor} !important;\n`;
            css += `}\n\n`;

            // div[class*='hl-text']
            css += `div[class*='hl-text'], div[class*='text-grey'] {\n`;
            if (innerTextFontSize) css += `  font-size: ${innerTextFontSize} !important ;\n`;
            if (labelsFontSize) css += `  font-size: ${labelsFontSize} !important ;\n`;
            if (labelsFontColor) css += `  color: ${labelsFontColor} !important;\n`;
            css += `}\n\n`;


            //global styles
            const globalfontSize = document.getElementById('globalfontSize').value;
            const globalfontColor = document.querySelector('input[name="globalfontColorType"]:checked').value === 'code' ?
                document
                .getElementById('globalfontColorCode').value : document.getElementById('globalfontColorPicker').value;
            const globalbgColorType = document.querySelector('input[name="globalbgColorType"]:checked').value;
            const globalbgGradientType = document.getElementById('globalbgGradientType').value;
            const globalbgGradientColors = document.querySelectorAll('.globalbgGradientColor');
            const globalfontFamily = document.getElementById('globalfontFamily').value;

            let globalbgGradient = '';

            if (globalbgColorType === 'code' || globalbgColorType === 'picker') {
                const globalbgColor = globalbgColorType === 'code' ? document.getElementById('globalbgColorCode').value :
                    document.getElementById('globalbgColorPicker').value;
                document.querySelector('body').style.backgroundColor = globalbgColor;
                document.querySelector('body').style.backgroundImage = 'none';
            } else if (globalbgColorType === 'gradient') {
                globalbgGradient = `linear-gradient(${globalbgGradientType}, `;
                globalbgGradientColors.forEach((color, index) => {
                    if (index !== 0) globalbgGradient += ', ';
                    globalbgGradient += color.value;
                });
                globalbgGradient += ')';
                document.querySelector('body').style.backgroundImage = globalbgGradient;
                document.querySelector('body').style.backgroundColor = 'transparent'; // Reset background color
            }

            document.querySelector('body').style.fontSize = globalfontSize;
            document.querySelector('body').style.color = globalfontColor;
            document.querySelector('body').style.fontFamily = globalfontFamily;


            css += `#app .location-dashboard-wrapper, .bg-gray-50 {\n`;
            if (globalbgColorType === 'code') css +=
                `  background-color: ${document.getElementById('globalbgColorCode').value} !important;\n`;
            if (globalbgColorType === 'picker') css +=
                `  background-color: ${document.getElementById('globalbgColorPicker').value} !important;\n`;
            if (globalbgColorType === 'gradient') css += `  background-image: ${globalbgGradient} !important;\n`;
            css += `}\n`;

            //top nav bar
            css +=
                `#app .location-dashboard-wrapper, .bg-gray-50 , .sidebar-v2-location .hl_header , #app section.w-full{\n`;
            if (globalbgColorType === 'code') css +=
                `  background-color: ${document.getElementById('globalbgColorCode').value} !important;\n`;
            if (globalbgColorType === 'picker') css +=
                `  background-color: ${document.getElementById('globalbgColorPicker').value} !important;\n`;
            if (globalbgColorType === 'gradient') css += `  background-image: ${globalbgGradient} !important;\n`;

            // a bit box shadow
            css += `  border-bottom: 1px solid #e5e7eb !important;\n`;
            css += `}\n`;



            //overall global text
            css +=
                `#app .hl-card:not(.opportunitiesCard) .hl-card-content :is([class*='text-gray-'], span, h1, h2, h3, h4, h5, p, div) {\n`;
            css += `  color: ${globalfontColor} !important;\n`;
            css += `}\n`;

            //overall font family
            css += `#app `;
            css += `  font-family: ${globalfontFamily} !important;\n`;
            css += `}\n`;

            css += `#app button:not(.dropdown-toggle) {\n`;
            if (globalbgColorType === 'code') css +=
                `  background-color: ${document.getElementById('globalbgColorCode').value} !important;\n`;
            if (globalbgColorType === 'picker') css +=
                `  background-color: ${document.getElementById('globalbgColorPicker').value} !important;\n`;
            if (globalbgColorType === 'gradient') css += `  background-image: ${globalbgGradient} !important;\n`;

            css += ` color: ${globalfontColor} !important;\n`;

            css += `}\n`;

            //top nav items 

            css += `[class*='navitem'], .hl-title-container .title , .timestamp-style {\n`;
            css += `  color: ${globalfontColor} !important;\n`;
            css += `}\n`;

            //conversation section
            css += `.hl_conversations--wrap .hl_conversations--messages-list-v2,
                            .hl_conversations--wrap .hl_conversations--message,
                            .message-input-wrap, .opportunityCard ,
                            .hl_conversations--message-header,
                            .hl-select .n-bese-selection-label ,
                             [class*="bg-gray-"],
                             [class*="bg-white"],
                            .messages-list--item-v2,
                            #fc-calendar-container,
                            .n-date-panel-calendar,
                            .ghl-table-container,
                            .hl-card-content,
                            .hl-modal
                    
                            {\n`;
            if (globalbgColorType === 'code') css +=
                `  background-color: ${document.getElementById('globalbgColorCode').value} !important;\n`;
            if (globalbgColorType === 'picker') css +=
                `  background-color: ${document.getElementById('globalbgColorPicker').value} !important;\n`;
            if (globalbgColorType === 'gradient') css += `  background-image: ${globalbgGradient} !important;\n`;
            css += `  color: ${globalfontColor} !important;\n`;
            css += `}\n`;

            //inputs
            css += `.n-input,  .btn-light, .hl-text-input
            {\n`;
             if (globalbgColorType === 'code') css +=
                `  background-color: ${document.getElementById('globalbgColorCode').value} !important;\n`;
            if (globalbgColorType === 'picker') css +=
                `  background-color: ${document.getElementById('globalbgColorPicker').value} !important;\n`;
            if (globalbgColorType === 'gradient') css += `  background-image: ${globalbgGradient} !important;\n`;
            css += `  color: ${globalfontColor} !important;\n`;
            css += `}\n`;






            //table at dashboard
            //             #app .hl-card:not(.opportunitiesCard) .hl-card-content table td {
            //   background-image: linear-gradient(to right, #98b215, #000000) !important;
            //   --n-td-text-color: white !important;
            //   box-shadow: none !important;  /* Reset the box shadow */
            // }

            css += `#app .hl-card:not(.opportunitiesCard) .hl-card-content table td {\n`;
            //  card styles
            if (cardbgColorType === 'code') css +=
                `  background-color: ${document.getElementById('cardbgColorCode').value} !important;\n`;
            if (cardbgColorType === 'picker') css +=
                `  background-color: ${document.getElementById('cardbgColorPicker').value} !important;\n`;
            if (cardbgColorType === 'gradient') css += `  background-image: ${cardbgGradient} !important;\n`;
            css += `  --n-td-text-color: ${cardfontColor} !important;\n`;
            css += `  box-shadow: none !important;\n`;
            css += `}\n`;


            //location swither dropdown
            css +=
                `#location-switcher-sidbar-v2, #globalSearchOpener, #quickActions, .hl_v2-location_switcher, .n-date-picker#location-dashboard_date-picker,  .n-input, .n-base-selection, .n-base-select-menu .n-base-select-option {\n`;
            if (globalbgColorType === 'code') css +=
                `  background-color: ${document.getElementById('globalbgColorCode').value} !important;\n`;
            if (globalbgColorType === 'picker') css +=
                `  background-color: ${document.getElementById('globalbgColorPicker').value} !important;\n`;
            if (globalbgColorType === 'gradient') css += `  background-image: ${globalbgGradient} !important;\n`;
            css += `  color: ${globalfontColor} !important;\n`;
            css += `}\n`;

            //location swither card(modal)
            css += `[class*="hl_text-"], [class*='bg-gray-'], [class*='text-gray-'] {\n`;
            css += `  color: ${globalfontColor} !important;\n`;
            css += `}\n`;


            //buttons change 
            css += `.n-button--default-type, .message-header-actions button{\n`;
            if (globalbgColorType === 'code') css +=
                `  background-color: ${document.getElementById('globalbgColorCode').value} !important;\n`;
            if (globalbgColorType === 'picker') css +=
                `  background-color: ${document.getElementById('globalbgColorPicker').value} !important;\n`;
            if (globalbgColorType === 'gradient') css += `  background-image: ${globalbgGradient} !important;\n`;
            css += `  color: ${globalfontColor} !important;\n`;
            css += `}\n`;

            //messages selcted
            css += `.messages-list--item-v2,
                    .hl_smartlists--wrap table{\n`;
            
            if (cardbgColorType === 'code') css +=
                `  background-color: ${document.getElementById('cardbgColorCode').value} !important;\n`;
            if (cardbgColorType === 'picker') css +=
                `  background-color: ${document.getElementById('cardbgColorPicker').value} !important;\n`;
            if (cardbgColorType === 'gradient') css += `  background-image: ${cardbgGradient} !important;\n`;
            css += `  color: ${globalfontColor} !important;\n`;
            css += `}\n`;
            
             css += `.hl_conversations--message , .message-input-wrap {\n`;
            
             if (globalbgColorType === 'code') css +=
                `  background-color: ${document.getElementById('globalbgColorCode').value} !important;\n`;
            if (globalbgColorType === 'picker') css +=
                `  background-color: ${document.getElementById('globalbgColorPicker').value} !important;\n`;
            if (globalbgColorType === 'gradient') css += `  background-image: ${globalbgGradient} !important;\n`;
            css += `  color: ${globalfontColor} !important;\n`;
            css += `}\n`;
            
            
             //lanuchpad container based on card customizer

            css += `.launchpad-item-container, .hl_conversations--wrap .hl-card-content{\n`
             if (cardbgColorType === 'code') css +=
                `  background-color: ${document.getElementById('cardbgColorCode').value} !important;\n`;
            if (cardbgColorType === 'picker') css +=
                `  background-color: ${document.getElementById('cardbgColorPicker').value} !important;\n`;
            if (cardbgColorType === 'gradient') css += `  background-image: ${cardbgGradient} !important;\n`;
            css += `  color: ${cardfontColor} !important;\n`;
            css += `}\n`;
            
             
            
            css += `.opportunitiesCard .hl-card-content {\n`;
            if (cardbgColorType === 'code') css +=
                `  background-color: ${document.getElementById('cardbgColorCode').value} !important;\n`;
            if (cardbgColorType === 'picker') css +=
                `  background-color: ${document.getElementById('cardbgColorPicker').value} !important;\n`;
            if (cardbgColorType === 'gradient') css += `  background-image: ${cardbgGradient} !important;\n`;

            css += ` color: ${cardfontColor} !important;\n`;

            css += `}\n`;


            //launch pad container
            css += `.launchpad-item-container .launchpad-item-sub-container {\n`;
            css += `  color: ${cardfontColor} !important;\n`;
           if (cardbgColorType === 'code') css +=
                `  background-color: ${document.getElementById('cardbgColorCode').value} !important;\n`;
            if (cardbgColorType === 'picker') css +=
                `  background-color: ${document.getElementById('cardbgColorPicker').value} !important;\n`;
            if (cardbgColorType === 'gradient') css += `  background-image: ${cardbgGradient} !important;\n`;
            css += `}\n`;
            
            
            
            
            //contacts page table inners text
             css += `.hl_smartlists--wrap div {\n`;
            css += `  color: ${globalfontColor} !important;\n`;
            css += `}\n`;
            
            //flex page bar // contact's header and footer 
            css += `div.flex-page-bar {\n`;
            css += ` color: ${cardfontColor} !important;\n`;
             if (cardbgColorType === 'code') css +=
                `  background-color: ${document.getElementById('cardbgColorCode').value} !important;\n`;
            if (cardbgColorType === 'picker') css +=
                `  background-color: ${document.getElementById('cardbgColorPicker').value} !important;\n`;
            if (cardbgColorType === 'gradient') css += `  background-image: ${cardbgGradient} !important;\n`;
            css += `}\n`;
            
            


             //make the scroll bar color 
            css += `::-webkit-scrollbar {\n`;
            css += `  width: 12px !important;\n`;
            css += `}\n`;

            css += `::-webkit-scrollbar-track {\n`;
            css += `  background: ${globalbgColorType === 'code' ? document.getElementById('globalbgColorCode').value : document.getElementById('globalbgColorPicker').value} !important;\n`;
            css += `}\n`;

            css += `::-webkit-scrollbar-thumb {\n`;
            css += `  background-color: ${globalfontColor} !important;\n`;
            css += `  border-radius: 20px !important;\n`;
            css += `  border: 3px solid ${globalbgColorType === 'code' ? document.getElementById('globalbgColorCode').value : document.getElementById('globalbgColorPicker').value} !important;\n`;
            css += `}\n`;

            css += `::-webkit-scrollbar-thumb:hover {\n`;
            css += `  background-color: ${globalfontColor} !important;\n`;
            css += `}\n`;
            
            
            






            //attach custom css as well
            const customCSS = document.getElementById('customCSS').value;
            if (customCSS) {
                css += customCSS;
            }

            finalCSS = css;

            navigator.clipboard.writeText(css).then(() => {
                if (makealert) {
                    toastr.success('CSS copied to clipboard!');
                }
            });
        }


        document.addEventListener('DOMContentLoaded', applyStyles);
        //submit form to save css
        document.querySelector('.save-css-btn').addEventListener('click', function(e) {
            e.preventDefault();
            
            // Call copyCSS function to get the final CSS
            copyCSS(false);

            const form = document.getElementById('customizerForm');
            const formData = new FormData(form);

            // Gather all key-value pairs from the form
            const formDataObj = {};
            formData.forEach((value, key) => {
                formDataObj[key] = value;
            });

            // Handle gradient colors
            const bgGradientColors = document.querySelectorAll('.bgGradientColor');
            const bgGradientColorsArr = [];
            bgGradientColors.forEach(color => {
                bgGradientColorsArr.push(color.value);
            });

            const cardbgGradientColors = document.querySelectorAll('.cardbgGradientColor');
            const cardbgGradientColorsArr = [];
            cardbgGradientColors.forEach(color => {
                cardbgGradientColorsArr.push(color.value);
            });

            const globalbgGradientColors = document.querySelectorAll('.globalbgGradientColor');
            const globalbgGradientColorsArr = [];
            globalbgGradientColors.forEach(color => {
                globalbgGradientColorsArr.push(color.value);
            });

            formDataObj.bgGradientColors = bgGradientColorsArr;
            formDataObj.cardbgGradientColors = cardbgGradientColorsArr;
            formDataObj.globalbgGradientColors = globalbgGradientColorsArr;




            const jsonDesign = JSON.stringify(formDataObj);

            formData.append('dashboard_css', finalCSS);
            formData.append('dashboard_json', jsonDesign);
            
            showLoader();

            fetch("{{ route('style.dashboard.save') }}", {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    hideLoader();
                    if (data.status === 'success') {
                          toastr.success('CSS and Design saved successfully!');
                    } else {
                          toastr.error('Failed to save CSS and Design!');
                    }
                });
        });


        $(document).ready(function() {
            //call the style functions
            applyStyles();
            applyStylesCard();
            applyStylesGlobal();
            applyStylesChart();

        })
    </script>
@endsection
