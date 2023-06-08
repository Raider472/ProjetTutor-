#!/bin/sh
trap "exit" SIGINT
trap "exit" SIGTERM

npm i
npm run dev
