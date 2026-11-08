<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ?? 'PharmacyPOS' }}</title>
    <style>
        :root {
            --bg: #f4f6f8;
            --panel: #ffffff;
            --panel-soft: #f9fbfc;
            --text: #18212b;
            --muted: #667483;
            --border: #d6dde5;
            --accent: #0f766e;
            --accent-dark: #115e59;
            --danger: #b42318;
            --warn: #b54708;
            --ok: #027a48;
        }

        * { box-sizing: border-box; }
        
        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg);
            color: var(--text);
        }
        a { color: inherit; text-decoration: none; }
        .shell { min-height: 100vh; }
        .topbar {
            background: #10333c;
            color: #fff;
            padding: 14px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }
        .brand { font-size: 22px; font-weight: 700; }
        .brand small { display: block; font-size: 12px; font-weight: 500; color: #c3d2d7; }
        .nav { display: flex; flex-wrap: wrap; gap: 10px; }
        .nav a {
            padding: 10px 14px;
            border-radius: 8px;
            background: rgba(255,255,255,0.08);
            font-size: 14px;
            font-weight: 600;
        }
        .nav a.active { background: #fff; color: #10333c; }
        .container { max-width: 1400px; margin: 0 auto; padding: 22px; }
        .page-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 16px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }
        .page-head h1 { margin: 0; font-size: 28px; }
        .page-head p { margin: 6px 0 0; color: var(--muted); }
        .grid { display: grid; gap: 18px; }
        .grid-2 { grid-template-columns: 1.3fr .9fr; }
        .grid-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .grid-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        .panel {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 18px;
          
        }
        .panel-dashboard {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 18px;
            height: 450px;
            overflow-y: auto;
        }
        .panel.soft { background: var(--panel-soft); }
        .panel h2, .panel h3 { margin: 0 0 12px; }
        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }
        .stat {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 16px;
        }
        .stat-label { color: var(--muted); font-size: 13px; margin-bottom: 8px; }
        .stat-value { font-size: 28px; font-weight: 700; }
        .row { display: flex; gap: 12px; flex-wrap: wrap; }
        .row > * { flex: 1 1 160px; }
        label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; }
        input, select, textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: #fff;
            font: inherit;
            color: var(--text);
        }
        textarea { min-height: 84px; }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        th, td {
            border-bottom: 1px solid var(--border);
            padding: 10px 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            color: var(--muted);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .04em;
        }
        .table-wrap { overflow-x: auto; }
        .actions { display: flex; gap: 8px; flex-wrap: wrap; }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px 14px;
            border: 0;
            border-radius: 8px;
            cursor: pointer;
            font: inherit;
            font-weight: 600;
            background: #dfe7ee;
            color: var(--text);
        }
        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: var(--accent-dark); }
        .btn-danger { background: #fee4e2; color: var(--danger); }
        .btn-soft { background: #edf2f7; }
        .btn-full { width: 100%; }
        .pill {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }
        .pill-ok { background: #dcfae6; color: var(--ok); }
        .pill-warn { background: #fef0c7; color: var(--warn); }
        .pill-danger { background: #fee4e2; color: var(--danger); }
        .message {
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 16px;
            font-weight: 600;
        }
        .message-success { background: #dcfae6; color: var(--ok); }
        .message-error { background: #fee4e2; color: var(--danger); }
        .meta { color: var(--muted); font-size: 13px; }
        .stack { display: grid; gap: 12px; }
        .split {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }
        #cart-item td {
            vertical-align: middle;
        }
        input.no-spin::-webkit-outer-spin-button,
        input.no-spin::-webkit-inner-spin-button{
            -webkit-apperarance: none;
            margin:0;
        }
        input.no-spin[type=number] {
            -moz-appearance: textfield;
        }
        .numeric { text-align: right; white-space: nowrap; }
        .invoice-box {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 26px;
        }
        .errors { margin: 0 0 16px; padding-left: 18px; color: var(--danger); }
        @media (max-width: 980px) {
            .grid-2, .grid-4, .stats { grid-template-columns: 1fr; }
        }

        [7:45 pm, 04/11/2026] Raju: <!-- পেজিনেশন লিঙ্ক দেখানোর জায়গা -->
<nav>
    <ul class="pagination justify-content-center mt-3" id="pagination-container">
        <!-- জাভাস্ক্রিপ্ট দিয়ে এখানে পেজিনেশন বাটনগুলো আসবে -->
    </ul>
</nav>
[9:22 pm, 04/11/2026] Raju: /* পেজিনেশন কন্টেইনারকে পাশাপাশি (flex) করার জন্য */
#pagination-container {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 20px 0;
}

/* পেজিনেশনের প্রতিটি লিঙ্কের ডিজাইন */
#pagination-container li a {
    display: block;
    padding: 8px 14px;
    margin: 0 2px;
    text-decoration: none;
    color: #333;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    transition: background-color 0.2s;
}

/* হোভার এফেক্ট */
#pagination-container li a:hover {
    background-color: #f1f1f1;
}

/* ১. এক্টিভ (Active) বা যে পেজে আছেন সেটি হাইলাইট করার জন্য */
#pagination-container li.active a, 
#pagination-container li.active {
    background-color: #007bff !important; /* আপনার পছন্দের কালার দিতে পারেন */
    color: #fff !important;
    border-color: #007bff !important;
}

/* ২. ডিজেবল (Disabled) বা যে পেজগুলোতে যাওয়া যাবে না */
#pagination-container li.disabled a,
#pagination-container li.disabled {
    color: #6c757d;
    background-color: #f8f9fa;
    border-color: #dee2e6;
    cursor: not-allowed;
    pointer-events: none; /* ক্লিক করা থেকে বিরত রাখবে */
}

    /* টোস্টের প্রধান পজিশন (স্ক্রিনের উপরে ডানপাশে থাকবে) */
.toast-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

/* গ্রিন সাকসেস টোস্টের স্টাইল */
.toast-success {
    background-color: #28a745; /* সবুজ ব্যাকগ্রাউন্ড */
    color: #ffffff;
    padding: 12px 20px;
    border-radius: 6px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
    
    min-width: 500px;
    animation: slideIn 0.3s ease-in-out, fadeOut 0.5s ease-in-out 3s forwards;
}
/* রেড ডেনজার/এরর টোস্টের স্টাইল */
.toast-error {
    background-color: #dc3545; /* লাল ব্যাকগ্রাউন্ড */
    color: #ffffff;
    padding: 12px 20px;
    border-radius: 6px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
    min-width: 500px;
    animation: slideIn 0.3s ease-in-out, fadeOut 0.5s ease-in-out 3s forwards;
}

/* স্লাইড ইন এনিমেশন */
@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

/* ফেড আউট এনিমেশন */
@keyframes fadeOut {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
    }
}    
        .app-footer {
    text-align: center;
    padding: 18px;
    font-size: 13px;
    color: var(--muted);
    border-top: 1px solid var(--border);
    background: var(--panel-soft);
    margin-top: 40px;
}

.app-footer a {
    color: var(--accent);
    font-weight: 600;
    transition: 0.2s;
}

.app-footer a:hover {
    color: var(--accent-dark);
}
    </style>
</head>
<body>
<div class="shell">
    <header class="topbar">
        <div class="brand">
            Smart Pharma
            <small>Customer satisfaction is our first priority</small>
        </div>
        <nav class="nav">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('pos.index') }}" class="{{ request()->routeIs('pos.index') ? 'active' : '' }}">POS</a>
            <a href="{{ route('medicines.index') }}" class="{{ request()->routeIs('medicines.*') ? 'active' : '' }}">Medicines</a>
            <a href="{{ route('customers.index') }}" class="{{ request()->routeIs('customers.*') ? 'active' : '' }}">Customers</a>
            <a href="{{ route('expense') }}" class="{{ request()->routeIs('expense') ? 'active' : '' }}">Expense</a>
        </nav>
    </header>

    <main class="container">
        @if(session('success'))
            <div class="message message-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <ul class="errors">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @yield('content')
    </main>
    <footer class="app-footer">
    Developed by 
    <a href="https://smartitcorner.com" target="_blank">Ismail Hossain</a>
    <span> version 7.0.1</span>
</footer>
</body>
</html>
