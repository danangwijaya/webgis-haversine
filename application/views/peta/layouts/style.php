<style>
         .map{
            height: 98vh;
            width: 99vw;
            position: absolute;
            z-index: 2;
            top: 0;
            left: 0;
            bottom: 0;
        } 
        #sidebar {
        padding: 1vh;
        position: absolute;
        width: 8em;
        height: 3em;
        top: 1%;
        left: 90%;
        z-index: 6;
        text-align: center;
        opacity: 0.9;
        border-radius: 6px;
        background-color: #dde2ff;
        color: black;
        transition: all 0.6s cubic-bezier(0.945, 0.02, 0.27, 0.665);
        transform-origin: bottom left;
        }
  
        #sidebar .headersidebar {
        padding: 0px 0px 20px 0px;
        }

        #sidebar ul.components {
        padding: 20px 0;
        border-bottom: 1px solid #47748b;
        }

        #sidebar ul li a {
        display: block;
        }
        .results {
        background-color: white;
        opacity: 0.8;
        position: absolute;
        z-index: 3;
        top: 12px;
        right: 12px;
        width: 320px;
        height: 480px;
        overflow-y: scroll;
        }

        .input{
        padding: 1vh;
        position: absolute;
        width: 20em;
        height: 30em;
        top: 14%;
        right: 2%;
        z-index: 6;
        opacity: 0.9;
        border-radius: 6px;
        background-color: #dde2ff;
        color: black;
        transition: all 0.6s cubic-bezier(0.945, 0.02, 0.27, 0.665);
        transform-origin: bottom left;
        }
        .horizontal-menu {
        display: flex;
        flex-direction: row;
        }

        .horizontal-menu li {
            margin-right: 10px; /* Spasi antar item */
        }

        .horizontal-menu li:last-child {
            margin-right: 0; /* Hapus spasi pada item terakhir */
        }
    </style>