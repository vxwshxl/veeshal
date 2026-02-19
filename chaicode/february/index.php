<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>February 2026 - Valentine's Special</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Nunito:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #d32f2f; /* Deep Red */
            --secondary-color: #ff8fa3; /* Soft Pink */
            --bg-gradient: linear-gradient(135deg, #fff0f3 0%, #fff5f8 100%);
            --card-bg: rgba(255, 255, 255, 0.9);
            --text-main: #4a4a4a;
            --heart-color: #ff4d6d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: var(--bg-gradient);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
            padding: 2rem;
            position: relative;
        }

        /* Floating Hearts Background Animation */
        .bg-hearts {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
            pointer-events: none;
        }

        .bg-heart {
            position: absolute;
            font-size: 2rem;
            color: rgba(255, 77, 109, 0.1);
            animation: floatUp 15s linear infinite;
        }

        @keyframes floatUp {
            0% { transform: translateY(100vh) scale(0.5); opacity: 0; }
            50% { opacity: 0.5; }
            100% { transform: translateY(-10vh) scale(1); opacity: 0; }
        }

        .main-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(255, 77, 109, 0.15);
            padding: 3rem;
            width: 100%;
            max-width: 1000px;
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 3rem;
            border: 2px solid #fff;
            position: relative;
            overflow: hidden;
        }

        /* Decorative Envelope Flap Effect */
        .main-card::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: var(--secondary-color);
            border-radius: 50%;
            opacity: 0.2;
        }

        /* Left Side: Art & Theme */
        .theme-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .month-name {
            font-family: 'Great Vibes', cursive;
            font-size: 6rem;
            color: var(--primary-color);
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            transform: rotate(-5deg);
            margin-bottom: 1rem;
        }

        .year-text {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--text-main);
            letter-spacing: 0.2rem;
            margin-bottom: 2rem;
        }

        .love-quote {
            font-style: italic;
            color: #777;
            margin-top: 2rem;
            font-size: 0.9rem;
            max-width: 80%;
        }

        /* SVG Illustration */
        .illustration {
            width: 250px;
            margin: 0 auto;
        }

        /* Right Side: Calendar Table */
        .calendar-section {
            padding: 1rem; 
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 1rem; /* Gap between rows */
        }

        thead th {
            font-size: 0.9rem;
            text-transform: uppercase;
            color: #888;
            padding-bottom: 1rem;
            font-weight: 600;
        }

        tbody td {
            text-align: center;
            vertical-align: middle;
            height: 3rem;
            width: 3rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-main);
            position: relative;
            transition: all 0.3s ease;
        }

        /* Hover effect on dates */
        tbody td:not(:empty):hover {
            color: var(--primary-color);
            cursor: pointer;
            transform: scale(1.1);
        }

        /* Current Date Highlight */
        .current-date {
            color: white !important;
            position: relative;
            z-index: 1;
        }

        .current-date::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40px;
            height: 40px;
            background-color: var(--heart-color);
            border-radius: 50%; /* Circle fallback */
            /* Heart Shape using clip-path could be used, but let's stick to a nice Circle or custom svg bg */
            /* Let's try a heart shape via CSS or SVG background */
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23ff4d6d'%3E%3Cpath d='M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            z-index: -1;
            width: 45px;
            height: 45px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: translate(-50%, -50%) scale(1); }
            50% { transform: translate(-50%, -50%) scale(1.1); }
            100% { transform: translate(-50%, -50%) scale(1); }
        }

        /* Empty cells */
        td:empty {
            pointer-events: none;
        }

        /* Sunday Color */
        tbody td:nth-child(1), thead th:nth-child(1) {
            color: var(--primary-color);
        }

        /* Validations for screen size */
        @media (max-width: 850px) {
            .main-card {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            .month-name {
                font-size: 4rem;
            }
        }
    </style>
</head>
<body>

    <div class="bg-hearts">
        <!-- Generative hearts via simple script or just some static span elements for effect -->
        <span class="bg-heart" style="left: 10%; animation-delay: 0s;">&#10084;</span>
        <span class="bg-heart" style="left: 30%; animation-delay: 2s;">&#10084;</span>
        <span class="bg-heart" style="left: 70%; animation-delay: 4s;">&#10084;</span>
        <span class="bg-heart" style="left: 90%; animation-delay: 1s;">&#10084;</span>
        <span class="bg-heart" style="left: 50%; animation-delay: 3s;">&#10084;</span>
    </div>

    <div class="main-card">
        <!-- Left Section -->
        <div class="theme-section">
            <h1 class="month-name">February</h1>
            <div class="year-text">2026</div>
            
            <div class="illustration">
                <!-- Simple Artistic Vector of Two Birds or Hearts -->
                <svg viewBox="0 0 200 150" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#ff4d6d" d="M92.71,7.27L92.71,7.27c-9.71-9.69-25.46-9.69-35.18,0c-9.71,9.69-9.71,25.41,0,35.1L92.71,77.5l35.18-35.1
                        c9.71-9.69,9.71-25.41,0-35.1C118.17-2.42,102.42-2.42,92.71,7.27z" opacity="0.8"/>
                    <path fill="#d32f2f" d="M107.29,7.27L107.29,7.27c9.71-9.69,25.46-9.69,35.18,0c9.71,9.69,9.71,25.41,0,35.1L107.29,77.5l-35.18-35.1
                        c-9.71-9.69-9.71-25.41,0-35.1C81.83-2.42,97.58-2.42,107.29,7.27z" opacity="0.6" transform="translate(40, 40) scale(0.6)"/>
                </svg>
            </div>

            <p class="love-quote">"All you need is love. But a little chocolate now and then doesn't hurt."</p>
        </div>

        <!-- Right Section -->
        <div class="calendar-section">
            <table>
                <thead>
                    <tr>
                        <th>Sun</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Calendar variables
                        $year = 2026;
                        $month = 2;
                        $today = date('j'); // Current day of the month
                        
                        // First day of February 2026
                        $firstDayTimestamp = mktime(0, 0, 0, $month, 1, $year);
                        $daysInMonth = date('t', $firstDayTimestamp); // 28
                        $dayOfWeek = date('w', $firstDayTimestamp); // 0 (Sun)
                        
                        echo "<tr>";

                        // Empty cells before first day
                        for ($i = 0; $i < $dayOfWeek; $i++) {
                            echo "<td></td>";
                        }

                        // Days of month
                        for ($day = 1; $day <= $daysInMonth; $day++) {
                            $highlightClass = "";
                            // Check if the day matches today's date
                            if ($day == $today) {
                                $highlightClass = 'class="current-date"';
                            }
                            
                            echo "<td $highlightClass>$day</td>";

                            // Week wrap
                            if (($day + $dayOfWeek) % 7 == 0) {
                                echo "</tr><tr>";
                            }
                        }

                        // Empty cells at end
                        $remainingDays = (7 - (($daysInMonth + $dayOfWeek) % 7)) % 7;
                        if ($remainingDays < 7) {
                            for ($i = 0; $i < $remainingDays; $i++) {
                                echo "<td></td>";
                            }
                        }

                        echo "</tr>";
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
