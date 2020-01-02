# Weight-tracker

Just a quick little two-person weight-tracker for a new year's resolution contest. Meant to be used as a daily tracker.

## Features

- Chart shows daily progress
- +/- indicator shows if you're on track from previous entry
- Prevents multiple entries per day
- Mobile-friendly
  - Add to Homescreen (progressive web app)
  - Pull-to-refresh
- Easily deployable to free tier Heroku with JawsDB Mysql

Note that there is no authentication, authorization, or any security features really at all.

It's purpose-built for a two-person challenge, nothing more.

## Built with

- [Laravel](https://laravel.com/)
- [Chart.js](https://www.chartjs.org/)
- [Vue](https://vuejs.org/)
- [TailwindCSS](https://tailwindcss.com/)

## Responsive

I'm no designer, but it looks ok on desktop or mobile.

### Desktop
![Desktop screenshot](https://raw.githubusercontent.com/dsamojlenko/weight-tracker/master/screenshots/desktop.png)

### Mobile

<img src="https://raw.githubusercontent.com/dsamojlenko/weight-tracker/master/screenshots/mobile.png" width="300">

## TODO

- Currently,the charts will get messed up if one person misses a day of reporting.