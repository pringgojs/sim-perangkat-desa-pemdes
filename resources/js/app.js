import "./bootstrap";
import "flowbite";
import "preline";

import Clipboard from "@ryangjchandler/alpine-clipboard";
import ApexCharts from "apexcharts";
import anchor from "@alpinejs/anchor";

window.ApexCharts = ApexCharts;

Alpine.plugin(Clipboard);
Alpine.plugin(anchor);
