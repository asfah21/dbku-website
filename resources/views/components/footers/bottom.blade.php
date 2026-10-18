<footer class="flex items-center justify-center fixed bottom-0 left-0 z-20 w-full p-4 bg-white border-t border-gray-200 shadow dark:bg-gray-800 dark:border-gray-600">
    <span class="footer-text flex items-center text-gray-900 dark:text-gray-100">
        Made with
        <i class="fa fa-heart pulse mx-2"></i>
        by<a href="./" target="_blank" class="author-link ml-1 text-blue-500 dark:text-blue-400 hover:underline">Azvan IT</a>&nbsp;GSI
    </span>
    <style>
        .footer-text {
            color: #666;
            font-size: 14px;
            text-align: center;
        }

        .footer-text a {
            color: #000;
            text-decoration: none;
        }

        .footer-text a:hover {
            color: #007fd4;
            text-decoration: underline;
        }

        /* Heart Icon Animation */
        .fa-heart {
            color: #E90606;
            font-size: 16px;
            animation: pulse 0.8s infinite alternate;
            -webkit-animation: pulse 0.8s infinite alternate;
        }

        @-webkit-keyframes pulse {
            to {
                transform: scale(1.2);
            }
        }

        @keyframes pulse {
            to {
                transform: scale(1.2);
            }
        }
    </style>
</footer>
