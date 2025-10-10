2025-Oct-06 02:22:04.712723
Starting deployment of Sebstepss/rintegra:main to localhost.
2025-Oct-06 02:22:04.867744
Preparing container with helper image: ghcr.io/coollabsio/coolify-helper:1.0.11.
2025-Oct-06 02:22:05.696152
----------------------------------------
2025-Oct-06 02:22:05.699800
Importing Sebstepss/rintegra:main (commit sha HEAD) to /artifacts/ukcg0ooccc8w8kwwwssg000o.
2025-Oct-06 02:22:07.152298
Image not found (uwkkkggsgckoso80ccsg0wc4:ef3e30e242a6674dfb71f6eab66e92cf5b21dc95). Building new image.
2025-Oct-06 02:22:07.996971
----------------------------------------
2025-Oct-06 02:22:08.001023
⚠️ Build-time environment variable warning: APP_ENV=production
2025-Oct-06 02:22:08.004815
Affects: Laravel/Symfony
2025-Oct-06 02:22:08.008607
Issue: May affect dependency installation and build optimizations
2025-Oct-06 02:22:08.012351
Recommendation: Consider using "local" or "development" for build
2025-Oct-06 02:22:08.016037
2025-Oct-06 02:22:08.019794
💡 Tips to resolve build issues:
2025-Oct-06 02:22:08.023521
1. Set these variables as "Runtime only" in the environment variables settings
2025-Oct-06 02:22:08.027208
2. Use different values for build-time (e.g., NODE_ENV=development for build)
2025-Oct-06 02:22:08.030882
3. Consider using multi-stage Docker builds to separate build and runtime environments
2025-Oct-06 02:22:08.338383
----------------------------------------
2025-Oct-06 02:22:08.342511
Building docker image started.
2025-Oct-06 02:22:08.346715
To check the current progress, click on Show Debug Logs.
2025-Oct-06 02:23:33.408151
Oops something is not okay, are you okay? 😢
2025-Oct-06 02:23:33.429805
#0 building with "default" instance using docker driver
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#1 [internal] load build definition from Dockerfile
2025-Oct-06 02:23:33.429805
#1 transferring dockerfile: 2.21kB done
2025-Oct-06 02:23:33.429805
#1 DONE 0.0s
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#2 [internal] load metadata for docker.io/library/php:8.2-fpm-alpine
2025-Oct-06 02:23:33.429805
#2 ...
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#3 [internal] load metadata for docker.io/library/composer:latest
2025-Oct-06 02:23:33.429805
#3 DONE 0.5s
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#2 [internal] load metadata for docker.io/library/php:8.2-fpm-alpine
2025-Oct-06 02:23:33.429805
#2 DONE 0.5s
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#4 [internal] load .dockerignore
2025-Oct-06 02:23:33.429805
#4 transferring context: 249B done
2025-Oct-06 02:23:33.429805
#4 DONE 0.0s
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#5 FROM docker.io/library/composer:latest@sha256:adca13b22c7b77f7fc606353453be12ba93e0917c332b8b0fa5efe3a85bf27ab
2025-Oct-06 02:23:33.429805
#5 resolve docker.io/library/composer:latest@sha256:adca13b22c7b77f7fc606353453be12ba93e0917c332b8b0fa5efe3a85bf27ab 0.0s done
2025-Oct-06 02:23:33.429805
#5 ...
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#6 [internal] load build context
2025-Oct-06 02:23:33.429805
#6 transferring context: 45.41MB 0.2s done
2025-Oct-06 02:23:33.429805
#6 DONE 0.2s
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#5 FROM docker.io/library/composer:latest@sha256:adca13b22c7b77f7fc606353453be12ba93e0917c332b8b0fa5efe3a85bf27ab
2025-Oct-06 02:23:33.429805
#5 sha256:b3bc9ac1fabef725bfb8cae8430b40abe92bc31c086cab027185fadcc71e9315 3.80kB / 3.80kB done
2025-Oct-06 02:23:33.429805
#5 sha256:adca13b22c7b77f7fc606353453be12ba93e0917c332b8b0fa5efe3a85bf27ab 10.10kB / 10.10kB done
2025-Oct-06 02:23:33.429805
#5 sha256:1d1f3041725a04bc6b040feaeab0a1a66b1c2b950ef50ccda52b344fe076fdcb 11.77kB / 11.77kB done
2025-Oct-06 02:23:33.429805
#5 sha256:02e20bee4789b3efba3eb9880aeaaf4c13e6263cd79978da3db73d0c25127be8 0B / 934B 0.5s
2025-Oct-06 02:23:33.429805
#5 sha256:01c2a936c44a3f90ca9bb77c75706af43b3d2f44ed6ede4e171329a78a790db6 0B / 5.93MB 0.5s
2025-Oct-06 02:23:33.429805
#5 sha256:103731ea806d2baabba81246429d8da0b3c89d8ad9856bf92415acd5f9c80d15 0B / 215B 0.5s
2025-Oct-06 02:23:33.429805
#5 sha256:01c2a936c44a3f90ca9bb77c75706af43b3d2f44ed6ede4e171329a78a790db6 4.19MB / 5.93MB 0.6s
2025-Oct-06 02:23:33.429805
#5 sha256:103731ea806d2baabba81246429d8da0b3c89d8ad9856bf92415acd5f9c80d15 215B / 215B 0.6s done
2025-Oct-06 02:23:33.429805
#5 extracting sha256:01c2a936c44a3f90ca9bb77c75706af43b3d2f44ed6ede4e171329a78a790db6
2025-Oct-06 02:23:33.429805
#5 sha256:02e20bee4789b3efba3eb9880aeaaf4c13e6263cd79978da3db73d0c25127be8 934B / 934B 0.6s done
2025-Oct-06 02:23:33.429805
#5 sha256:01c2a936c44a3f90ca9bb77c75706af43b3d2f44ed6ede4e171329a78a790db6 5.93MB / 5.93MB 0.6s done
2025-Oct-06 02:23:33.429805
#5 extracting sha256:01c2a936c44a3f90ca9bb77c75706af43b3d2f44ed6ede4e171329a78a790db6 0.1s done
2025-Oct-06 02:23:33.429805
#5 sha256:d34ce04f95166a53d64e0a20ba204ef7b91ef4c3507f5e200fb6ef60eed0a24f 0B / 484B 0.7s
2025-Oct-06 02:23:33.429805
#5 sha256:1f34de792613dd7edf3c6766483248c2fe987230e18957bec472a65d5023ec4f 0B / 13.67MB 0.7s
2025-Oct-06 02:23:33.429805
#5 sha256:8e85efba01306816714aefb1d018a4f07a989049e5ea7fec8bc3cf2e9ea732ca 3.15MB / 19.95MB 0.7s
2025-Oct-06 02:23:33.429805
#5 extracting sha256:02e20bee4789b3efba3eb9880aeaaf4c13e6263cd79978da3db73d0c25127be8 done
2025-Oct-06 02:23:33.429805
#5 extracting sha256:103731ea806d2baabba81246429d8da0b3c89d8ad9856bf92415acd5f9c80d15 done
2025-Oct-06 02:23:33.429805
#5 sha256:d34ce04f95166a53d64e0a20ba204ef7b91ef4c3507f5e200fb6ef60eed0a24f 484B / 484B 0.8s done
2025-Oct-06 02:23:33.429805
#5 sha256:1f34de792613dd7edf3c6766483248c2fe987230e18957bec472a65d5023ec4f 6.29MB / 13.67MB 0.9s
2025-Oct-06 02:23:33.429805
#5 sha256:8e85efba01306816714aefb1d018a4f07a989049e5ea7fec8bc3cf2e9ea732ca 19.95MB / 19.95MB 0.8s done
2025-Oct-06 02:23:33.429805
#5 sha256:7f3fa80949cbcc4888a1e2cb3f866086f5a7fc49dbc12df17e6db2ea06b1a0d4 2.45kB / 2.45kB 0.9s done
2025-Oct-06 02:23:33.429805
#5 sha256:d5fe723748b5fa36ef1dc7d2400ff6536108dff6ce8d3baa2e175a82b9156cd5 0B / 19.96kB 0.9s
2025-Oct-06 02:23:33.429805
#5 sha256:585a1c45dbded911fac84d7d7b4cc920931f87d41bc5353ae28a4bbc65f7356d 0B / 19.94kB 0.9s
2025-Oct-06 02:23:33.429805
#5 ...
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#7 [stage-0  1/17] FROM docker.io/library/php:8.2-fpm-alpine@sha256:b7355fb38ef93fd0ef6ccbecee006a25f9bb7fbb65a9f6b7a4721582b75c073a
2025-Oct-06 02:23:33.429805
#7 resolve docker.io/library/php:8.2-fpm-alpine@sha256:b7355fb38ef93fd0ef6ccbecee006a25f9bb7fbb65a9f6b7a4721582b75c073a done
2025-Oct-06 02:23:33.429805
#7 sha256:a992b4453c7ffe21584867dced3a8b82c896603a10bfe3f7ec734729e26fcda5 3.25kB / 3.25kB done
2025-Oct-06 02:23:33.429805
#7 sha256:b7355fb38ef93fd0ef6ccbecee006a25f9bb7fbb65a9f6b7a4721582b75c073a 10.31kB / 10.31kB done
2025-Oct-06 02:23:33.429805
#7 sha256:9eb344faa450364c3c3407507b04ad1bbf481e1dcfda15df7098fbfedbaa95cf 9.96kB / 9.96kB done
2025-Oct-06 02:23:33.429805
#7 sha256:4dd4fffaae092110322077044a2cdb1b8c7a98506ab7abbf0c59daf1bf03754e 3.46MB / 3.46MB 0.1s done
2025-Oct-06 02:23:33.429805
#7 sha256:634d0b9aae16344a6aa6cb11da905352e5147e2ebdd9531bd6ed9f97f1814ced 222B / 222B 0.1s done
2025-Oct-06 02:23:33.429805
#7 sha256:3523cc29a9bb7ff0bb48bb7c7666473bdc05f0b0fdf7f793732faa9bac5bb40c 934B / 934B 0.2s done
2025-Oct-06 02:23:33.429805
#7 extracting sha256:4dd4fffaae092110322077044a2cdb1b8c7a98506ab7abbf0c59daf1bf03754e 0.1s done
2025-Oct-06 02:23:33.429805
#7 sha256:8f2199a0a48c7a03ae5c47cb93f6d1c37f7e91009f6d2ebd738f8a573d330a7f 486B / 486B 0.2s done
2025-Oct-06 02:23:33.429805
#7 sha256:a588d6579d4e65e01e83bb6af46c6a97c7bf7e14d5a1bcb935a43d075de8660f 13.02MB / 13.02MB 0.5s done
2025-Oct-06 02:23:33.429805
#7 sha256:5af26cdaf1d2491da2048bc33cc13c72442ba295a37a08bf87705899147eb8c2 12.18MB / 12.18MB 0.3s done
2025-Oct-06 02:23:33.429805
#7 extracting sha256:3523cc29a9bb7ff0bb48bb7c7666473bdc05f0b0fdf7f793732faa9bac5bb40c done
2025-Oct-06 02:23:33.429805
#7 extracting sha256:634d0b9aae16344a6aa6cb11da905352e5147e2ebdd9531bd6ed9f97f1814ced done
2025-Oct-06 02:23:33.429805
#7 extracting sha256:5af26cdaf1d2491da2048bc33cc13c72442ba295a37a08bf87705899147eb8c2 0.0s done
2025-Oct-06 02:23:33.429805
#7 sha256:b368cb7dcabc71b81ed5d2a2c0f8c74deb489faca90feedfaf9b59fbd34a4424 2.45kB / 2.45kB 0.4s done
2025-Oct-06 02:23:33.429805
#7 sha256:4caa1ead2c3106a9ed5b01f6eb8265b76f9c449a807b3170d6e6f0e6ebb7c8c3 19.96kB / 19.96kB 0.4s done
2025-Oct-06 02:23:33.429805
#7 extracting sha256:8f2199a0a48c7a03ae5c47cb93f6d1c37f7e91009f6d2ebd738f8a573d330a7f done
2025-Oct-06 02:23:33.429805
#7 sha256:17041228ce21f78e1ba5dc41ec123d7a710bb8027efcb2b34bf421dabbc4e866 19.95kB / 19.95kB 0.4s done
2025-Oct-06 02:23:33.429805
#7 extracting sha256:a588d6579d4e65e01e83bb6af46c6a97c7bf7e14d5a1bcb935a43d075de8660f 0.3s done
2025-Oct-06 02:23:33.429805
#7 sha256:4f4fb700ef54461cfa02571ae0db9a0dc1e0cdb5577484a6d75e68dc38e8acc1 32B / 32B 0.5s done
2025-Oct-06 02:23:33.429805
#7 sha256:b590ae665dbb12d85c06115d87b13c92aa2c45635faeb7703699a5a6861bfcae 9.18kB / 9.18kB 0.5s done
2025-Oct-06 02:23:33.429805
#7 extracting sha256:b368cb7dcabc71b81ed5d2a2c0f8c74deb489faca90feedfaf9b59fbd34a4424 done
2025-Oct-06 02:23:33.429805
#7 extracting sha256:4caa1ead2c3106a9ed5b01f6eb8265b76f9c449a807b3170d6e6f0e6ebb7c8c3 done
2025-Oct-06 02:23:33.429805
#7 extracting sha256:17041228ce21f78e1ba5dc41ec123d7a710bb8027efcb2b34bf421dabbc4e866 done
2025-Oct-06 02:23:33.429805
#7 extracting sha256:4f4fb700ef54461cfa02571ae0db9a0dc1e0cdb5577484a6d75e68dc38e8acc1 done
2025-Oct-06 02:23:33.429805
#7 extracting sha256:b590ae665dbb12d85c06115d87b13c92aa2c45635faeb7703699a5a6861bfcae done
2025-Oct-06 02:23:33.429805
#7 DONE 0.9s
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#5 FROM docker.io/library/composer:latest@sha256:adca13b22c7b77f7fc606353453be12ba93e0917c332b8b0fa5efe3a85bf27ab
2025-Oct-06 02:23:33.429805
#5 sha256:1f34de792613dd7edf3c6766483248c2fe987230e18957bec472a65d5023ec4f 13.67MB / 13.67MB 1.0s done
2025-Oct-06 02:23:33.429805
#5 sha256:d5fe723748b5fa36ef1dc7d2400ff6536108dff6ce8d3baa2e175a82b9156cd5 19.96kB / 19.96kB 1.0s done
2025-Oct-06 02:23:33.429805
#5 extracting sha256:1f34de792613dd7edf3c6766483248c2fe987230e18957bec472a65d5023ec4f 0.1s done
2025-Oct-06 02:23:33.429805
#5 sha256:2523a2987c9b89db17c0c8e10e4743f764d7a00b611fae4c3fdb72ffa4fc119d 0B / 33.93MB 1.0s
2025-Oct-06 02:23:33.429805
#5 sha256:45f2d19c3446363785e481a7ba6e9118857e1cd01b9aa8959e8c764d67055760 0B / 257B 1.0s
2025-Oct-06 02:23:33.429805
#5 sha256:b96b3b70f35b4d250a0649336bfbd07a992b3e8af830cdd78febc50d4f854896 0B / 1.62MB 1.0s
2025-Oct-06 02:23:33.429805
#5 sha256:2523a2987c9b89db17c0c8e10e4743f764d7a00b611fae4c3fdb72ffa4fc119d 9.44MB / 33.93MB 1.1s
2025-Oct-06 02:23:33.429805
#5 sha256:45f2d19c3446363785e481a7ba6e9118857e1cd01b9aa8959e8c764d67055760 257B / 257B 1.0s done
2025-Oct-06 02:23:33.429805
#5 sha256:b96b3b70f35b4d250a0649336bfbd07a992b3e8af830cdd78febc50d4f854896 1.62MB / 1.62MB 1.1s done
2025-Oct-06 02:23:33.429805
#5 extracting sha256:d34ce04f95166a53d64e0a20ba204ef7b91ef4c3507f5e200fb6ef60eed0a24f done
2025-Oct-06 02:23:33.429805
#5 extracting sha256:8e85efba01306816714aefb1d018a4f07a989049e5ea7fec8bc3cf2e9ea732ca 0.1s
2025-Oct-06 02:23:33.429805
#5 sha256:194161dd706d963efbb4edc7d727633c2d82fb8f86e46cd882411a955155a3e5 0B / 420B 1.1s
2025-Oct-06 02:23:33.429805
#5 sha256:e7af40cb343154d2acc063e8097b98868c4a35b92f2db88b384f65c98c660060 0B / 93B 1.1s
2025-Oct-06 02:23:33.429805
#5 sha256:2523a2987c9b89db17c0c8e10e4743f764d7a00b611fae4c3fdb72ffa4fc119d 19.92MB / 33.93MB 1.2s
2025-Oct-06 02:23:33.429805
#5 sha256:194161dd706d963efbb4edc7d727633c2d82fb8f86e46cd882411a955155a3e5 420B / 420B 1.1s done
2025-Oct-06 02:23:33.429805
#5 sha256:2523a2987c9b89db17c0c8e10e4743f764d7a00b611fae4c3fdb72ffa4fc119d 31.46MB / 33.93MB 1.3s
2025-Oct-06 02:23:33.429805
#5 sha256:e7af40cb343154d2acc063e8097b98868c4a35b92f2db88b384f65c98c660060 93B / 93B 1.2s done
2025-Oct-06 02:23:33.429805
#5 sha256:2523a2987c9b89db17c0c8e10e4743f764d7a00b611fae4c3fdb72ffa4fc119d 33.93MB / 33.93MB 1.3s done
2025-Oct-06 02:23:33.429805
#5 extracting sha256:8e85efba01306816714aefb1d018a4f07a989049e5ea7fec8bc3cf2e9ea732ca 0.5s done
2025-Oct-06 02:23:33.429805
#5 extracting sha256:7f3fa80949cbcc4888a1e2cb3f866086f5a7fc49dbc12df17e6db2ea06b1a0d4 done
2025-Oct-06 02:23:33.429805
#5 extracting sha256:d5fe723748b5fa36ef1dc7d2400ff6536108dff6ce8d3baa2e175a82b9156cd5 done
2025-Oct-06 02:23:33.429805
#5 extracting sha256:585a1c45dbded911fac84d7d7b4cc920931f87d41bc5353ae28a4bbc65f7356d done
2025-Oct-06 02:23:33.429805
#5 extracting sha256:2523a2987c9b89db17c0c8e10e4743f764d7a00b611fae4c3fdb72ffa4fc119d
2025-Oct-06 02:23:33.429805
#5 extracting sha256:2523a2987c9b89db17c0c8e10e4743f764d7a00b611fae4c3fdb72ffa4fc119d 0.9s done
2025-Oct-06 02:23:33.429805
#5 extracting sha256:45f2d19c3446363785e481a7ba6e9118857e1cd01b9aa8959e8c764d67055760 done
2025-Oct-06 02:23:33.429805
#5 extracting sha256:b96b3b70f35b4d250a0649336bfbd07a992b3e8af830cdd78febc50d4f854896 0.0s done
2025-Oct-06 02:23:33.429805
#5 extracting sha256:194161dd706d963efbb4edc7d727633c2d82fb8f86e46cd882411a955155a3e5
2025-Oct-06 02:23:33.429805
#5 extracting sha256:194161dd706d963efbb4edc7d727633c2d82fb8f86e46cd882411a955155a3e5 done
2025-Oct-06 02:23:33.429805
#5 extracting sha256:e7af40cb343154d2acc063e8097b98868c4a35b92f2db88b384f65c98c660060 done
2025-Oct-06 02:23:33.429805
#5 DONE 2.6s
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#8 [stage-0  2/17] RUN apk add --no-cache     git     curl     libpng-dev     oniguruma-dev     libxml2-dev     zip     unzip     mysql-client     nginx     supervisor     nodejs     npm
2025-Oct-06 02:23:33.429805
#8 0.049 fetch https://dl-cdn.alpinelinux.org/alpine/v3.22/main/x86_64/APKINDEX.tar.gz
2025-Oct-06 02:23:33.429805
#8 0.130 fetch https://dl-cdn.alpinelinux.org/alpine/v3.22/community/x86_64/APKINDEX.tar.gz
2025-Oct-06 02:23:33.429805
#8 0.404 (1/43) Installing libexpat (2.7.3-r0)
2025-Oct-06 02:23:33.429805
#8 0.415 (2/43) Installing pcre2 (10.43-r1)
2025-Oct-06 02:23:33.429805
#8 0.425 (3/43) Installing git (2.49.1-r0)
2025-Oct-06 02:23:33.429805
#8 0.519 (4/43) Installing git-init-template (2.49.1-r0)
2025-Oct-06 02:23:33.429805
#8 0.524 (5/43) Installing libpng (1.6.47-r0)
2025-Oct-06 02:23:33.429805
#8 0.531 (6/43) Installing pkgconf (2.4.3-r0)
2025-Oct-06 02:23:33.429805
#8 0.544 (7/43) Installing zlib-dev (1.3.1-r2)
2025-Oct-06 02:23:33.429805
#8 0.549 (8/43) Installing libpng-dev (1.6.47-r0)
2025-Oct-06 02:23:33.429805
#8 0.555 (9/43) Installing xz-dev (5.8.1-r0)
2025-Oct-06 02:23:33.429805
#8 0.561 (10/43) Installing libxml2-utils (2.13.8-r0)
2025-Oct-06 02:23:33.429805
#8 0.566 (11/43) Installing libxml2-dev (2.13.8-r0)
2025-Oct-06 02:23:33.429805
#8 0.586 (12/43) Installing mariadb-common (11.4.8-r0)
2025-Oct-06 02:23:33.429805
#8 0.608 (13/43) Installing libstdc++ (14.2.0-r6)
2025-Oct-06 02:23:33.429805
#8 0.627 (14/43) Installing mariadb-client (11.4.8-r0)
2025-Oct-06 02:23:33.429805
#8 0.874 (15/43) Installing mysql-client (11.4.8-r0)
2025-Oct-06 02:23:33.429805
#8 0.874 (16/43) Installing nginx (1.28.0-r3)
2025-Oct-06 02:23:33.429805
#8 0.881 Executing nginx-1.28.0-r3.pre-install
2025-Oct-06 02:23:33.429805
#8 0.905 Executing nginx-1.28.0-r3.post-install
2025-Oct-06 02:23:33.429805
#8 0.909 (17/43) Installing ada-libs (2.9.2-r4)
2025-Oct-06 02:23:33.429805
#8 0.917 (18/43) Installing icu-data-en (76.1-r1)
2025-Oct-06 02:23:33.429805
#8 0.938 Executing icu-data-en-76.1-r1.post-install
2025-Oct-06 02:23:33.429805
#8 0.940 *
2025-Oct-06 02:23:33.429805
#8 0.940 * If you need ICU with non-English locales and legacy charset support, install
2025-Oct-06 02:23:33.429805
#8 0.940 * package icu-data-full.
2025-Oct-06 02:23:33.429805
#8 0.940 *
2025-Oct-06 02:23:33.429805
#8 0.940 (19/43) Installing icu-libs (76.1-r1)
2025-Oct-06 02:23:33.429805
#8 0.974 (20/43) Installing simdjson (3.12.0-r0)
2025-Oct-06 02:23:33.429805
#8 0.979 (21/43) Installing simdutf (7.2.1-r0)
2025-Oct-06 02:23:33.429805
#8 0.987 (22/43) Installing nodejs (22.16.0-r2)
2025-Oct-06 02:23:33.429805
#8 1.268 (23/43) Installing npm (11.3.0-r1)
2025-Oct-06 02:23:33.429805
#8 1.453 (24/43) Installing oniguruma-dev (6.9.10-r0)
2025-Oct-06 02:23:33.429805
#8 1.463 (25/43) Installing libbz2 (1.0.8-r6)
2025-Oct-06 02:23:33.429805
#8 1.466 (26/43) Installing libffi (3.4.8-r0)
2025-Oct-06 02:23:33.429805
#8 1.472 (27/43) Installing gdbm (1.24-r0)
2025-Oct-06 02:23:33.429805
#8 1.476 (28/43) Installing mpdecimal (4.0.1-r0)
2025-Oct-06 02:23:33.429805
#8 1.482 (29/43) Installing libpanelw (6.5_p20250503-r0)
2025-Oct-06 02:23:33.429805
#8 1.486 (30/43) Installing python3 (3.12.11-r0)
2025-Oct-06 02:23:33.429805
#8 1.656 (31/43) Installing python3-pycache-pyc0 (3.12.11-r0)
2025-Oct-06 02:23:33.429805
#8 1.764 (32/43) Installing pyc (3.12.11-r0)
2025-Oct-06 02:23:33.429805
#8 1.764 (33/43) Installing py3-parsing (3.2.3-r0)
2025-Oct-06 02:23:33.429805
#8 1.774 (34/43) Installing py3-parsing-pyc (3.2.3-r0)
2025-Oct-06 02:23:33.429805
#8 1.782 (35/43) Installing py3-packaging (25.0-r0)
2025-Oct-06 02:23:33.429805
#8 1.789 (36/43) Installing py3-packaging-pyc (25.0-r0)
2025-Oct-06 02:23:33.429805
#8 1.797 (37/43) Installing py3-setuptools (80.9.0-r0)
2025-Oct-06 02:23:33.429805
#8 1.860 (38/43) Installing py3-setuptools-pyc (80.9.0-r0)
2025-Oct-06 02:23:33.429805
#8 1.925 (39/43) Installing supervisor-pyc (4.2.5-r5)
2025-Oct-06 02:23:33.429805
#8 1.946 (40/43) Installing python3-pyc (3.12.11-r0)
2025-Oct-06 02:23:33.429805
#8 1.946 (41/43) Installing supervisor (4.2.5-r5)
2025-Oct-06 02:23:33.429805
#8 1.965 (42/43) Installing unzip (6.0-r15)
2025-Oct-06 02:23:33.429805
#8 1.976 (43/43) Installing zip (3.0-r13)
2025-Oct-06 02:23:33.429805
#8 1.988 Executing busybox-1.37.0-r18.trigger
2025-Oct-06 02:23:33.429805
#8 1.998 OK: 189 MiB in 84 packages
2025-Oct-06 02:23:33.429805
#8 DONE 2.1s
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#9 [stage-0  3/17] RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
2025-Oct-06 02:23:33.429805
#9 1.346 fetch https://dl-cdn.alpinelinux.org/alpine/v3.22/main/x86_64/APKINDEX.tar.gz
2025-Oct-06 02:23:33.429805
#9 1.406 fetch https://dl-cdn.alpinelinux.org/alpine/v3.22/community/x86_64/APKINDEX.tar.gz
2025-Oct-06 02:23:33.429805
#9 1.640 (1/27) Installing m4 (1.4.19-r4)
2025-Oct-06 02:23:33.429805
#9 1.648 (2/27) Installing perl (5.40.3-r0)
2025-Oct-06 02:23:33.429805
#9 1.910 (3/27) Installing autoconf (2.72-r1)
2025-Oct-06 02:23:33.429805
#9 1.934 (4/27) Installing dpkg-dev (1.22.15-r0)
2025-Oct-06 02:23:33.429805
#9 1.964 (5/27) Installing libmd (1.1.0-r0)
2025-Oct-06 02:23:33.429805
#9 1.968 (6/27) Installing dpkg (1.22.15-r0)
2025-Oct-06 02:23:33.429805
#9 1.988 (7/27) Installing libmagic (5.46-r2)
2025-Oct-06 02:23:33.429805
#9 2.017 (8/27) Installing file (5.46-r2)
2025-Oct-06 02:23:33.429805
#9 2.021 (9/27) Installing libstdc++-dev (14.2.0-r6)
2025-Oct-06 02:23:33.429805
#9 2.261 (10/27) Installing jansson (2.14.1-r0)
2025-Oct-06 02:23:33.429805
#9 2.265 (11/27) Installing binutils (2.44-r3)
2025-Oct-06 02:23:33.429805
#9 2.327 (12/27) Installing libgomp (14.2.0-r6)
2025-Oct-06 02:23:33.429805
#9 2.335 (13/27) Installing libatomic (14.2.0-r6)
2025-Oct-06 02:23:33.429805
#9 2.341 (14/27) Installing gmp (6.3.0-r3)
2025-Oct-06 02:23:33.429805
#9 2.348 (15/27) Installing isl26 (0.26-r1)
2025-Oct-06 02:23:33.429805
#9 2.364 (16/27) Installing mpfr4 (4.2.1_p1-r0)
2025-Oct-06 02:23:33.429805
#9 2.373 (17/27) Installing mpc1 (1.3.1-r1)
2025-Oct-06 02:23:33.429805
#9 2.377 (18/27) Installing gcc (14.2.0-r6)
2025-Oct-06 02:23:33.429805
#9 3.097 (19/27) Installing musl-dev (1.2.5-r10)
2025-Oct-06 02:23:33.429805
#9 3.156 (20/27) Installing g++ (14.2.0-r6)
2025-Oct-06 02:23:33.429805
#9 3.364 (21/27) Installing make (4.4.1-r3)
2025-Oct-06 02:23:33.429805
#9 3.370 (22/27) Installing re2c (4.2-r0)
2025-Oct-06 02:23:33.429805
#9 3.421 (23/27) Installing .phpize-deps (20251006.022213)
2025-Oct-06 02:23:33.429805
#9 3.421 (24/27) Installing perl-error (0.17030-r0)
2025-Oct-06 02:23:33.429805
#9 3.425 (25/27) Installing perl-git (2.49.1-r0)
2025-Oct-06 02:23:33.429805
#9 3.430 (26/27) Installing git-perl (2.49.1-r0)
2025-Oct-06 02:23:33.429805
#9 3.438 (27/27) Installing mariadb-client-perl (11.4.8-r0)
2025-Oct-06 02:23:33.429805
#9 3.445 Executing busybox-1.37.0-r18.trigger
2025-Oct-06 02:23:33.429805
#9 3.454 OK: 471 MiB in 111 packages
2025-Oct-06 02:23:33.429805
#9 3.553 Configuring for:
2025-Oct-06 02:23:33.429805
#9 3.553 PHP Api Version:         20220829
2025-Oct-06 02:23:33.429805
#9 3.553 Zend Module Api No:      20220829
2025-Oct-06 02:23:33.429805
#9 3.553 Zend Extension Api No:   420220829
2025-Oct-06 02:23:33.429805
#9 4.282 checking for grep that handles long lines and -e... /bin/grep
2025-Oct-06 02:23:33.429805
#9 4.320 checking for egrep... /bin/grep -E
2025-Oct-06 02:23:33.429805
#9 4.321 checking for a sed that does not truncate output... /bin/sed
2025-Oct-06 02:23:33.429805
#9 4.334 checking for pkg-config... /usr/bin/pkg-config
2025-Oct-06 02:23:33.429805
#9 4.334 checking pkg-config is at least version 0.9.0... yes
2025-Oct-06 02:23:33.429805
#9 4.335 checking for cc... cc
2025-Oct-06 02:23:33.429805
#9 4.353 checking whether the C compiler works... yes
2025-Oct-06 02:23:33.429805
#9 4.383 checking for C compiler default output file name... a.out
2025-Oct-06 02:23:33.429805
#9 4.384 checking for suffix of executables...
2025-Oct-06 02:23:33.429805
#9 4.413 checking whether we are cross compiling... no
2025-Oct-06 02:23:33.429805
#9 4.446 checking for suffix of object files... o
2025-Oct-06 02:23:33.429805
#9 4.466 checking whether the compiler supports GNU C... yes
2025-Oct-06 02:23:33.429805
#9 4.486 checking whether cc accepts -g... yes
2025-Oct-06 02:23:33.429805
#9 4.507 checking for cc option to enable C11 features... none needed
2025-Oct-06 02:23:33.429805
#9 4.561 checking how to run the C preprocessor... cc -E
2025-Oct-06 02:23:33.429805
#9 4.607 checking for egrep -e... (cached) /bin/grep -E
2025-Oct-06 02:23:33.429805
#9 4.607 checking for icc... no
2025-Oct-06 02:23:33.429805
#9 4.617 checking for suncc... no
2025-Oct-06 02:23:33.429805
#9 4.627 checking for system library directory... lib
2025-Oct-06 02:23:33.429805
#9 4.627 checking if compiler supports -Wl,-rpath,... yes
2025-Oct-06 02:23:33.429805
#9 4.659 checking build system type... x86_64-pc-linux-musl
2025-Oct-06 02:23:33.429805
#9 4.662 checking host system type... x86_64-pc-linux-musl
2025-Oct-06 02:23:33.429805
#9 4.662 checking target system type... x86_64-pc-linux-musl
2025-Oct-06 02:23:33.429805
#9 4.698 checking for PHP prefix... /usr/local
2025-Oct-06 02:23:33.429805
#9 4.698 checking for PHP includes... -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib
2025-Oct-06 02:23:33.429805
#9 4.698 checking for PHP extension directory... /usr/local/lib/php/extensions/no-debug-non-zts-20220829
2025-Oct-06 02:23:33.429805
#9 4.698 checking for PHP installed headers prefix... /usr/local/include/php
2025-Oct-06 02:23:33.429805
#9 4.698 checking if debug is enabled... no
2025-Oct-06 02:23:33.429805
#9 4.712 checking if zts is enabled... no
2025-Oct-06 02:23:33.429805
#9 4.725 checking for gawk... no
2025-Oct-06 02:23:33.429805
#9 4.725 checking for nawk... no
2025-Oct-06 02:23:33.429805
#9 4.725 checking for awk... awk
2025-Oct-06 02:23:33.429805
#9 4.725 checking if awk is broken... no
2025-Oct-06 02:23:33.429805
#9 4.726 checking for MySQL support for PDO... yes, shared
2025-Oct-06 02:23:33.429805
#9 4.726 checking for the location of libz... no
2025-Oct-06 02:23:33.429805
#9 4.727 checking for MySQL UNIX socket location...
2025-Oct-06 02:23:33.429805
#9 4.727 checking for PDO includes... /usr/local/include/php/ext
2025-Oct-06 02:23:33.429805
#9 4.730 checking for a sed that does not truncate output... /bin/sed
2025-Oct-06 02:23:33.429805
#9 4.732 checking for ld used by cc... /usr/x86_64-alpine-linux-musl/bin/ld
2025-Oct-06 02:23:33.429805
#9 4.739 checking if the linker (/usr/x86_64-alpine-linux-musl/bin/ld) is GNU ld... yes
2025-Oct-06 02:23:33.429805
#9 4.741 checking for /usr/x86_64-alpine-linux-musl/bin/ld option to reload object files... -r
2025-Oct-06 02:23:33.429805
#9 4.741 checking for BSD-compatible nm... /usr/bin/nm -B
2025-Oct-06 02:23:33.429805
#9 4.742 checking whether ln -s works... yes
2025-Oct-06 02:23:33.429805
#9 4.743 checking how to recognize dependent libraries... pass_all
2025-Oct-06 02:23:33.429805
#9 4.757 checking for stdio.h... yes
2025-Oct-06 02:23:33.429805
#9 4.772 checking for stdlib.h... yes
2025-Oct-06 02:23:33.429805
#9 4.787 checking for string.h... yes
2025-Oct-06 02:23:33.429805
#9 4.803 checking for inttypes.h... yes
2025-Oct-06 02:23:33.429805
#9 4.820 checking for stdint.h... yes
2025-Oct-06 02:23:33.429805
#9 4.837 checking for strings.h... yes
2025-Oct-06 02:23:33.429805
#9 4.854 checking for sys/stat.h... yes
2025-Oct-06 02:23:33.429805
#9 4.871 checking for sys/types.h... yes
2025-Oct-06 02:23:33.429805
#9 4.889 checking for unistd.h... yes
2025-Oct-06 02:23:33.429805
#9 4.908 checking for dlfcn.h... yes
2025-Oct-06 02:23:33.429805
#9 4.928 checking the maximum length of command line arguments... 98304
2025-Oct-06 02:23:33.429805
#9 4.930 checking command to parse /usr/bin/nm -B output from cc object... ok
2025-Oct-06 02:23:33.429805
#9 4.982 checking for objdir... .libs
2025-Oct-06 02:23:33.429805
#9 4.984 checking for ar... ar
2025-Oct-06 02:23:33.429805
#9 4.985 checking for ranlib... ranlib
2025-Oct-06 02:23:33.429805
#9 4.985 checking for strip... strip
2025-Oct-06 02:23:33.429805
#9 5.030 checking if cc supports -fno-rtti -fno-exceptions... no
2025-Oct-06 02:23:33.429805
#9 5.046 checking for cc option to produce PIC... -fPIC
2025-Oct-06 02:23:33.429805
#9 5.046 checking if cc PIC flag -fPIC works... yes
2025-Oct-06 02:23:33.429805
#9 5.062 checking if cc static flag -static works... yes
2025-Oct-06 02:23:33.429805
#9 5.090 checking if cc supports -c -o file.o... yes
2025-Oct-06 02:23:33.429805
#9 5.110 checking whether the cc linker (/usr/x86_64-alpine-linux-musl/bin/ld -m elf_x86_64) supports shared libraries... yes
2025-Oct-06 02:23:33.429805
#9 5.122 checking whether -lc should be explicitly linked in... no
2025-Oct-06 02:23:33.429805
#9 5.144 checking dynamic linker characteristics... GNU/Linux ld.so
2025-Oct-06 02:23:33.429805
#9 5.150 checking how to hardcode library paths into programs... immediate
2025-Oct-06 02:23:33.429805
#9 5.150 checking whether stripping libraries is possible... yes
2025-Oct-06 02:23:33.429805
#9 5.152 checking if libtool supports shared libraries... yes
2025-Oct-06 02:23:33.429805
#9 5.152 checking whether to build shared libraries... yes
2025-Oct-06 02:23:33.429805
#9 5.152 checking whether to build static libraries... no
2025-Oct-06 02:23:33.429805
#9 5.220
2025-Oct-06 02:23:33.429805
#9 5.220 creating libtool
2025-Oct-06 02:23:33.429805
#9 5.258 appending configuration tag "CXX" to libtool
2025-Oct-06 02:23:33.429805
#9 5.306 configure: patching config.h.in
2025-Oct-06 02:23:33.429805
#9 5.308 configure: creating ./config.status
2025-Oct-06 02:23:33.429805
#9 5.338 config.status: creating config.h
2025-Oct-06 02:23:33.429805
#9 5.361 /bin/sh /usr/src/php/ext/pdo_mysql/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/pdo_mysql -I/usr/src/php/ext/pdo_mysql/include -I/usr/src/php/ext/pdo_mysql/main -I/usr/src/php/ext/pdo_mysql -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/local/include/php/ext -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/pdo_mysql/pdo_mysql.c -o pdo_mysql.lo  -MMD -MF pdo_mysql.dep -MT pdo_mysql.lo
2025-Oct-06 02:23:33.429805
#9 5.410 mkdir .libs
2025-Oct-06 02:23:33.429805
#9 5.411  cc -I. -I/usr/src/php/ext/pdo_mysql -I/usr/src/php/ext/pdo_mysql/include -I/usr/src/php/ext/pdo_mysql/main -I/usr/src/php/ext/pdo_mysql -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/local/include/php/ext -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/pdo_mysql/pdo_mysql.c -MMD -MF pdo_mysql.dep -MT pdo_mysql.lo  -fPIC -DPIC -o .libs/pdo_mysql.o
2025-Oct-06 02:23:33.429805
#9 5.580 /bin/sh /usr/src/php/ext/pdo_mysql/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/pdo_mysql -I/usr/src/php/ext/pdo_mysql/include -I/usr/src/php/ext/pdo_mysql/main -I/usr/src/php/ext/pdo_mysql -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/local/include/php/ext -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/pdo_mysql/mysql_driver.c -o mysql_driver.lo  -MMD -MF mysql_driver.dep -MT mysql_driver.lo
2025-Oct-06 02:23:33.429805
#9 5.629  cc -I. -I/usr/src/php/ext/pdo_mysql -I/usr/src/php/ext/pdo_mysql/include -I/usr/src/php/ext/pdo_mysql/main -I/usr/src/php/ext/pdo_mysql -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/local/include/php/ext -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/pdo_mysql/mysql_driver.c -MMD -MF mysql_driver.dep -MT mysql_driver.lo  -fPIC -DPIC -o .libs/mysql_driver.o
2025-Oct-06 02:23:33.429805
#9 6.050 /bin/sh /usr/src/php/ext/pdo_mysql/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/pdo_mysql -I/usr/src/php/ext/pdo_mysql/include -I/usr/src/php/ext/pdo_mysql/main -I/usr/src/php/ext/pdo_mysql -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/local/include/php/ext -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/pdo_mysql/mysql_statement.c -o mysql_statement.lo  -MMD -MF mysql_statement.dep -MT mysql_statement.lo
2025-Oct-06 02:23:33.429805
#9 6.099  cc -I. -I/usr/src/php/ext/pdo_mysql -I/usr/src/php/ext/pdo_mysql/include -I/usr/src/php/ext/pdo_mysql/main -I/usr/src/php/ext/pdo_mysql -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/local/include/php/ext -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/pdo_mysql/mysql_statement.c -MMD -MF mysql_statement.dep -MT mysql_statement.lo  -fPIC -DPIC -o .libs/mysql_statement.o
2025-Oct-06 02:23:33.429805
#9 6.359 /bin/sh /usr/src/php/ext/pdo_mysql/libtool --tag=CC --mode=link cc -shared -I/usr/src/php/ext/pdo_mysql/include -I/usr/src/php/ext/pdo_mysql/main -I/usr/src/php/ext/pdo_mysql -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE  -Wl,-O1 -pie  -o pdo_mysql.la -export-dynamic -avoid-version -prefer-pic -module -rpath /usr/src/php/ext/pdo_mysql/modules  pdo_mysql.lo mysql_driver.lo mysql_statement.lo
2025-Oct-06 02:23:33.429805
#9 6.407 cc -shared  .libs/pdo_mysql.o .libs/mysql_driver.o .libs/mysql_statement.o   -Wl,-O1 -Wl,-soname -Wl,pdo_mysql.so -o .libs/pdo_mysql.so
2025-Oct-06 02:23:33.429805
#9 6.419 creating pdo_mysql.la
2025-Oct-06 02:23:33.429805
#9 6.422 (cd .libs && rm -f pdo_mysql.la && ln -s ../pdo_mysql.la pdo_mysql.la)
2025-Oct-06 02:23:33.429805
#9 6.423 /bin/sh /usr/src/php/ext/pdo_mysql/libtool --tag=CC --mode=install cp ./pdo_mysql.la /usr/src/php/ext/pdo_mysql/modules
2025-Oct-06 02:23:33.429805
#9 6.437 cp ./.libs/pdo_mysql.so /usr/src/php/ext/pdo_mysql/modules/pdo_mysql.so
2025-Oct-06 02:23:33.429805
#9 6.438 cp ./.libs/pdo_mysql.lai /usr/src/php/ext/pdo_mysql/modules/pdo_mysql.la
2025-Oct-06 02:23:33.429805
#9 6.447 PATH="$PATH:/sbin" ldconfig -n /usr/src/php/ext/pdo_mysql/modules
2025-Oct-06 02:23:33.429805
#9 6.450 ----------------------------------------------------------------------
2025-Oct-06 02:23:33.429805
#9 6.450 Libraries have been installed in:
2025-Oct-06 02:23:33.429805
#9 6.450    /usr/src/php/ext/pdo_mysql/modules
2025-Oct-06 02:23:33.429805
#9 6.450
2025-Oct-06 02:23:33.429805
#9 6.450 If you ever happen to want to link against installed libraries
2025-Oct-06 02:23:33.429805
#9 6.450 in a given directory, LIBDIR, you must either use libtool, and
2025-Oct-06 02:23:33.429805
#9 6.450 specify the full pathname of the library, or use the `-LLIBDIR'
2025-Oct-06 02:23:33.429805
#9 6.450 flag during linking and do at least one of the following:
2025-Oct-06 02:23:33.429805
#9 6.450    - add LIBDIR to the `LD_LIBRARY_PATH' environment variable
2025-Oct-06 02:23:33.429805
#9 6.450      during execution
2025-Oct-06 02:23:33.429805
#9 6.450    - add LIBDIR to the `LD_RUN_PATH' environment variable
2025-Oct-06 02:23:33.429805
#9 6.450      during linking
2025-Oct-06 02:23:33.429805
#9 6.450    - use the `-Wl,--rpath -Wl,LIBDIR' linker flag
2025-Oct-06 02:23:33.429805
#9 6.450
2025-Oct-06 02:23:33.429805
#9 6.450 See any operating system documentation about shared libraries for
2025-Oct-06 02:23:33.429805
#9 6.450 more information, such as the ld(1) and ld.so(8) manual pages.
2025-Oct-06 02:23:33.429805
#9 6.451 ----------------------------------------------------------------------
2025-Oct-06 02:23:33.429805
#9 6.451
2025-Oct-06 02:23:33.429805
#9 6.452 Build complete.
2025-Oct-06 02:23:33.429805
#9 6.452 Don't forget to run 'make test'.
2025-Oct-06 02:23:33.429805
#9 6.453
2025-Oct-06 02:23:33.429805
#9 6.465 + strip --strip-all modules/pdo_mysql.so
2025-Oct-06 02:23:33.429805
#9 6.484 Installing shared extensions:     /usr/local/lib/php/extensions/no-debug-non-zts-20220829/
2025-Oct-06 02:23:33.429805
#9 6.548 find . -name \*.gcno -o -name \*.gcda | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 6.551 find . -name \*.lo -o -name \*.o -o -name \*.dep | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 6.554 find . -name \*.la -o -name \*.a | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 6.557 find . -name \*.so | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 6.559 find . -name .libs -a -type d|xargs rm -rf
2025-Oct-06 02:23:33.429805
#9 6.561 rm -f libphp.la      modules/* libs/*
2025-Oct-06 02:23:33.429805
#9 6.562 rm -f ext/opcache/jit/zend_jit_x86.c
2025-Oct-06 02:23:33.429805
#9 6.562 rm -f ext/opcache/jit/zend_jit_arm64.c
2025-Oct-06 02:23:33.429805
#9 6.563 rm -f ext/opcache/minilua
2025-Oct-06 02:23:33.429805
#9 6.592 Configuring for:
2025-Oct-06 02:23:33.429805
#9 6.592 PHP Api Version:         20220829
2025-Oct-06 02:23:33.429805
#9 6.592 Zend Module Api No:      20220829
2025-Oct-06 02:23:33.429805
#9 6.592 Zend Extension Api No:   420220829
2025-Oct-06 02:23:33.429805
#9 7.309 checking for grep that handles long lines and -e... /bin/grep
2025-Oct-06 02:23:33.429805
#9 7.346 checking for egrep... /bin/grep -E
2025-Oct-06 02:23:33.429805
#9 7.347 checking for a sed that does not truncate output... /bin/sed
2025-Oct-06 02:23:33.429805
#9 7.359 checking for pkg-config... /usr/bin/pkg-config
2025-Oct-06 02:23:33.429805
#9 7.359 checking pkg-config is at least version 0.9.0... yes
2025-Oct-06 02:23:33.429805
#9 7.360 checking for cc... cc
2025-Oct-06 02:23:33.429805
#9 7.378 checking whether the C compiler works... yes
2025-Oct-06 02:23:33.429805
#9 7.408 checking for C compiler default output file name... a.out
2025-Oct-06 02:23:33.429805
#9 7.408 checking for suffix of executables...
2025-Oct-06 02:23:33.429805
#9 7.438 checking whether we are cross compiling... no
2025-Oct-06 02:23:33.429805
#9 7.472 checking for suffix of object files... o
2025-Oct-06 02:23:33.429805
#9 7.492 checking whether the compiler supports GNU C... yes
2025-Oct-06 02:23:33.429805
#9 7.511 checking whether cc accepts -g... yes
2025-Oct-06 02:23:33.429805
#9 7.532 checking for cc option to enable C11 features... none needed
2025-Oct-06 02:23:33.429805
#9 7.585 checking how to run the C preprocessor... cc -E
2025-Oct-06 02:23:33.429805
#9 7.631 checking for egrep -e... (cached) /bin/grep -E
2025-Oct-06 02:23:33.429805
#9 7.631 checking for icc... no
2025-Oct-06 02:23:33.429805
#9 7.643 checking for suncc... no
2025-Oct-06 02:23:33.429805
#9 7.655 checking for system library directory... lib
2025-Oct-06 02:23:33.429805
#9 7.655 checking if compiler supports -Wl,-rpath,... yes
2025-Oct-06 02:23:33.429805
#9 7.688 checking build system type... x86_64-pc-linux-musl
2025-Oct-06 02:23:33.429805
#9 7.690 checking host system type... x86_64-pc-linux-musl
2025-Oct-06 02:23:33.429805
#9 7.690 checking target system type... x86_64-pc-linux-musl
2025-Oct-06 02:23:33.429805
#9 7.726 checking for PHP prefix... /usr/local
2025-Oct-06 02:23:33.429805
#9 7.726 checking for PHP includes... -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib
2025-Oct-06 02:23:33.429805
#9 7.726 checking for PHP extension directory... /usr/local/lib/php/extensions/no-debug-non-zts-20220829
2025-Oct-06 02:23:33.429805
#9 7.726 checking for PHP installed headers prefix... /usr/local/include/php
2025-Oct-06 02:23:33.429805
#9 7.727 checking if debug is enabled... no
2025-Oct-06 02:23:33.429805
#9 7.739 checking if zts is enabled... no
2025-Oct-06 02:23:33.429805
#9 7.752 checking for gawk... no
2025-Oct-06 02:23:33.429805
#9 7.752 checking for nawk... no
2025-Oct-06 02:23:33.429805
#9 7.752 checking for awk... awk
2025-Oct-06 02:23:33.429805
#9 7.752 checking if awk is broken... no
2025-Oct-06 02:23:33.429805
#9 7.753 checking whether to enable multibyte string support... yes, shared
2025-Oct-06 02:23:33.429805
#9 7.753 checking whether to enable multibyte regex support (requires oniguruma)... yes
2025-Oct-06 02:23:33.429805
#9 7.754 checking for oniguruma... yes
2025-Oct-06 02:23:33.429805
#9 7.759 checking if oniguruma has an invalid entry for KOI8 encoding... yes
2025-Oct-06 02:23:33.429805
#9 7.912 checking for a sed that does not truncate output... /bin/sed
2025-Oct-06 02:23:33.429805
#9 7.914 checking for ld used by cc... /usr/x86_64-alpine-linux-musl/bin/ld
2025-Oct-06 02:23:33.429805
#9 7.922 checking if the linker (/usr/x86_64-alpine-linux-musl/bin/ld) is GNU ld... yes
2025-Oct-06 02:23:33.429805
#9 7.924 checking for /usr/x86_64-alpine-linux-musl/bin/ld option to reload object files... -r
2025-Oct-06 02:23:33.429805
#9 7.924 checking for BSD-compatible nm... /usr/bin/nm -B
2025-Oct-06 02:23:33.429805
#9 7.925 checking whether ln -s works... yes
2025-Oct-06 02:23:33.429805
#9 7.925 checking how to recognize dependent libraries... pass_all
2025-Oct-06 02:23:33.429805
#9 7.940 checking for stdio.h... yes
2025-Oct-06 02:23:33.429805
#9 7.955 checking for stdlib.h... yes
2025-Oct-06 02:23:33.429805
#9 7.971 checking for string.h... yes
2025-Oct-06 02:23:33.429805
#9 7.987 checking for inttypes.h... yes
2025-Oct-06 02:23:33.429805
#9 8.004 checking for stdint.h... yes
2025-Oct-06 02:23:33.429805
#9 8.022 checking for strings.h... yes
2025-Oct-06 02:23:33.429805
#9 8.039 checking for sys/stat.h... yes
2025-Oct-06 02:23:33.429805
#9 8.056 checking for sys/types.h... yes
2025-Oct-06 02:23:33.429805
#9 8.074 checking for unistd.h... yes
2025-Oct-06 02:23:33.429805
#9 8.094 checking for dlfcn.h... yes
2025-Oct-06 02:23:33.429805
#9 8.114 checking the maximum length of command line arguments... 98304
2025-Oct-06 02:23:33.429805
#9 8.115 checking command to parse /usr/bin/nm -B output from cc object... ok
2025-Oct-06 02:23:33.429805
#9 8.170 checking for objdir... .libs
2025-Oct-06 02:23:33.429805
#9 8.171 checking for ar... ar
2025-Oct-06 02:23:33.429805
#9 8.172 checking for ranlib... ranlib
2025-Oct-06 02:23:33.429805
#9 8.172 checking for strip... strip
2025-Oct-06 02:23:33.429805
#9 8.215 checking if cc supports -fno-rtti -fno-exceptions... no
2025-Oct-06 02:23:33.429805
#9 8.232 checking for cc option to produce PIC... -fPIC
2025-Oct-06 02:23:33.429805
#9 8.232 checking if cc PIC flag -fPIC works... yes
2025-Oct-06 02:23:33.429805
#9 8.247 checking if cc static flag -static works... yes
2025-Oct-06 02:23:33.429805
#9 8.276 checking if cc supports -c -o file.o... yes
2025-Oct-06 02:23:33.429805
#9 8.296 checking whether the cc linker (/usr/x86_64-alpine-linux-musl/bin/ld -m elf_x86_64) supports shared libraries... yes
2025-Oct-06 02:23:33.429805
#9 8.307 checking whether -lc should be explicitly linked in... no
2025-Oct-06 02:23:33.429805
#9 8.329 checking dynamic linker characteristics... GNU/Linux ld.so
2025-Oct-06 02:23:33.429805
#9 8.334 checking how to hardcode library paths into programs... immediate
2025-Oct-06 02:23:33.429805
#9 8.334 checking whether stripping libraries is possible... yes
2025-Oct-06 02:23:33.429805
#9 8.336 checking if libtool supports shared libraries... yes
2025-Oct-06 02:23:33.429805
#9 8.336 checking whether to build shared libraries... yes
2025-Oct-06 02:23:33.429805
#9 8.336 checking whether to build static libraries... no
2025-Oct-06 02:23:33.429805
#9 8.402
2025-Oct-06 02:23:33.429805
#9 8.402 creating libtool
2025-Oct-06 02:23:33.429805
#9 8.440 appending configuration tag "CXX" to libtool
2025-Oct-06 02:23:33.429805
#9 8.491 configure: patching config.h.in
2025-Oct-06 02:23:33.429805
#9 8.493 configure: creating ./config.status
2025-Oct-06 02:23:33.429805
#9 8.524 config.status: creating config.h
2025-Oct-06 02:23:33.429805
#9 8.565 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/mbstring.c -o mbstring.lo  -MMD -MF mbstring.dep -MT mbstring.lo
2025-Oct-06 02:23:33.429805
#9 8.618 mkdir .libs
2025-Oct-06 02:23:33.429805
#9 8.619  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/mbstring.c -MMD -MF mbstring.dep -MT mbstring.lo  -fPIC -DPIC -o .libs/mbstring.o
2025-Oct-06 02:23:33.429805
#9 10.66 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/php_unicode.c -o php_unicode.lo  -MMD -MF php_unicode.dep -MT php_unicode.lo
2025-Oct-06 02:23:33.429805
#9 10.73  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/php_unicode.c -MMD -MF php_unicode.dep -MT php_unicode.lo  -fPIC -DPIC -o .libs/php_unicode.o
2025-Oct-06 02:23:33.429805
#9 10.98 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/mb_gpc.c -o mb_gpc.lo  -MMD -MF mb_gpc.dep -MT mb_gpc.lo
2025-Oct-06 02:23:33.429805
#9 11.04  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/mb_gpc.c -MMD -MF mb_gpc.dep -MT mb_gpc.lo  -fPIC -DPIC -o .libs/mb_gpc.o
2025-Oct-06 02:23:33.429805
#9 11.29 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/php_mbregex.c -o php_mbregex.lo  -MMD -MF php_mbregex.dep -MT php_mbregex.lo
2025-Oct-06 02:23:33.429805
#9 11.35  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/php_mbregex.c -MMD -MF php_mbregex.dep -MT php_mbregex.lo  -fPIC -DPIC -o .libs/php_mbregex.o
2025-Oct-06 02:23:33.429805
#9 11.92 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/html_entities.c -o libmbfl/filters/html_entities.lo  -MMD -MF libmbfl/filters/html_entities.dep -MT libmbfl/filters/html_entities.lo
2025-Oct-06 02:23:33.429805
#9 11.98 mkdir libmbfl/filters/.libs
2025-Oct-06 02:23:33.429805
#9 11.98  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/html_entities.c -MMD -MF libmbfl/filters/html_entities.dep -MT libmbfl/filters/html_entities.lo  -fPIC -DPIC -o libmbfl/filters/.libs/html_entities.o
2025-Oct-06 02:23:33.429805
#9 12.07 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_7bit.c -o libmbfl/filters/mbfilter_7bit.lo  -MMD -MF libmbfl/filters/mbfilter_7bit.dep -MT libmbfl/filters/mbfilter_7bit.lo
2025-Oct-06 02:23:33.429805
#9 12.12  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_7bit.c -MMD -MF libmbfl/filters/mbfilter_7bit.dep -MT libmbfl/filters/mbfilter_7bit.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_7bit.o
2025-Oct-06 02:23:33.429805
#9 12.23 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_base64.c -o libmbfl/filters/mbfilter_base64.lo  -MMD -MF libmbfl/filters/mbfilter_base64.dep -MT libmbfl/filters/mbfilter_base64.lo
2025-Oct-06 02:23:33.429805
#9 12.29  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_base64.c -MMD -MF libmbfl/filters/mbfilter_base64.dep -MT libmbfl/filters/mbfilter_base64.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_base64.o
2025-Oct-06 02:23:33.429805
#9 12.51 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_big5.c -o libmbfl/filters/mbfilter_big5.lo  -MMD -MF libmbfl/filters/mbfilter_big5.dep -MT libmbfl/filters/mbfilter_big5.lo
2025-Oct-06 02:23:33.429805
#9 12.56  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_big5.c -MMD -MF libmbfl/filters/mbfilter_big5.dep -MT libmbfl/filters/mbfilter_big5.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_big5.o
2025-Oct-06 02:23:33.429805
#9 13.17 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_cp5022x.c -o libmbfl/filters/mbfilter_cp5022x.lo  -MMD -MF libmbfl/filters/mbfilter_cp5022x.dep -MT libmbfl/filters/mbfilter_cp5022x.lo
2025-Oct-06 02:23:33.429805
#9 13.23  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_cp5022x.c -MMD -MF libmbfl/filters/mbfilter_cp5022x.dep -MT libmbfl/filters/mbfilter_cp5022x.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_cp5022x.o
2025-Oct-06 02:23:33.429805
#9 13.86 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_cp51932.c -o libmbfl/filters/mbfilter_cp51932.lo  -MMD -MF libmbfl/filters/mbfilter_cp51932.dep -MT libmbfl/filters/mbfilter_cp51932.lo
2025-Oct-06 02:23:33.429805
#9 13.92  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_cp51932.c -MMD -MF libmbfl/filters/mbfilter_cp51932.dep -MT libmbfl/filters/mbfilter_cp51932.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_cp51932.o
2025-Oct-06 02:23:33.429805
#9 14.23 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_cp932.c -o libmbfl/filters/mbfilter_cp932.lo  -MMD -MF libmbfl/filters/mbfilter_cp932.dep -MT libmbfl/filters/mbfilter_cp932.lo
2025-Oct-06 02:23:33.429805
#9 14.28  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_cp932.c -MMD -MF libmbfl/filters/mbfilter_cp932.dep -MT libmbfl/filters/mbfilter_cp932.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_cp932.o
2025-Oct-06 02:23:33.429805
#9 14.74 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_cp936.c -o libmbfl/filters/mbfilter_cp936.lo  -MMD -MF libmbfl/filters/mbfilter_cp936.dep -MT libmbfl/filters/mbfilter_cp936.lo
2025-Oct-06 02:23:33.429805
#9 14.79  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_cp936.c -MMD -MF libmbfl/filters/mbfilter_cp936.dep -MT libmbfl/filters/mbfilter_cp936.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_cp936.o
2025-Oct-06 02:23:33.429805
#9 15.24 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_gb18030.c -o libmbfl/filters/mbfilter_gb18030.lo  -MMD -MF libmbfl/filters/mbfilter_gb18030.dep -MT libmbfl/filters/mbfilter_gb18030.lo
2025-Oct-06 02:23:33.429805
#9 15.29  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_gb18030.c -MMD -MF libmbfl/filters/mbfilter_gb18030.dep -MT libmbfl/filters/mbfilter_gb18030.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_gb18030.o
2025-Oct-06 02:23:33.429805
#9 15.80 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_euc_cn.c -o libmbfl/filters/mbfilter_euc_cn.lo  -MMD -MF libmbfl/filters/mbfilter_euc_cn.dep -MT libmbfl/filters/mbfilter_euc_cn.lo
2025-Oct-06 02:23:33.429805
#9 15.85  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_euc_cn.c -MMD -MF libmbfl/filters/mbfilter_euc_cn.dep -MT libmbfl/filters/mbfilter_euc_cn.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_euc_cn.o
2025-Oct-06 02:23:33.429805
#9 16.14 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_euc_jp.c -o libmbfl/filters/mbfilter_euc_jp.lo  -MMD -MF libmbfl/filters/mbfilter_euc_jp.dep -MT libmbfl/filters/mbfilter_euc_jp.lo
2025-Oct-06 02:23:33.429805
#9 16.19  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_euc_jp.c -MMD -MF libmbfl/filters/mbfilter_euc_jp.dep -MT libmbfl/filters/mbfilter_euc_jp.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_euc_jp.o
2025-Oct-06 02:23:33.429805
#9 16.41 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_euc_jp_win.c -o libmbfl/filters/mbfilter_euc_jp_win.lo  -MMD -MF libmbfl/filters/mbfilter_euc_jp_win.dep -MT libmbfl/filters/mbfilter_euc_jp_win.lo
2025-Oct-06 02:23:33.429805
#9 16.46  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_euc_jp_win.c -MMD -MF libmbfl/filters/mbfilter_euc_jp_win.dep -MT libmbfl/filters/mbfilter_euc_jp_win.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_euc_jp_win.o
2025-Oct-06 02:23:33.429805
#9 16.90 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_euc_kr.c -o libmbfl/filters/mbfilter_euc_kr.lo  -MMD -MF libmbfl/filters/mbfilter_euc_kr.dep -MT libmbfl/filters/mbfilter_euc_kr.lo
2025-Oct-06 02:23:33.429805
#9 16.95  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_euc_kr.c -MMD -MF libmbfl/filters/mbfilter_euc_kr.dep -MT libmbfl/filters/mbfilter_euc_kr.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_euc_kr.o
2025-Oct-06 02:23:33.429805
#9 17.13 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_euc_tw.c -o libmbfl/filters/mbfilter_euc_tw.lo  -MMD -MF libmbfl/filters/mbfilter_euc_tw.dep -MT libmbfl/filters/mbfilter_euc_tw.lo
2025-Oct-06 02:23:33.429805
#9 17.19  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_euc_tw.c -MMD -MF libmbfl/filters/mbfilter_euc_tw.dep -MT libmbfl/filters/mbfilter_euc_tw.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_euc_tw.o
2025-Oct-06 02:23:33.429805
#9 17.46 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_htmlent.c -o libmbfl/filters/mbfilter_htmlent.lo  -MMD -MF libmbfl/filters/mbfilter_htmlent.dep -MT libmbfl/filters/mbfilter_htmlent.lo
2025-Oct-06 02:23:33.429805
#9 17.51  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_htmlent.c -MMD -MF libmbfl/filters/mbfilter_htmlent.dep -MT libmbfl/filters/mbfilter_htmlent.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_htmlent.o
2025-Oct-06 02:23:33.429805
#9 17.74 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_hz.c -o libmbfl/filters/mbfilter_hz.lo  -MMD -MF libmbfl/filters/mbfilter_hz.dep -MT libmbfl/filters/mbfilter_hz.lo
2025-Oct-06 02:23:33.429805
#9 17.79  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_hz.c -MMD -MF libmbfl/filters/mbfilter_hz.dep -MT libmbfl/filters/mbfilter_hz.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_hz.o
2025-Oct-06 02:23:33.429805
#9 18.33 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_iso2022_jp_ms.c -o libmbfl/filters/mbfilter_iso2022_jp_ms.lo  -MMD -MF libmbfl/filters/mbfilter_iso2022_jp_ms.dep -MT libmbfl/filters/mbfilter_iso2022_jp_ms.lo
2025-Oct-06 02:23:33.429805
#9 18.39  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_iso2022_jp_ms.c -MMD -MF libmbfl/filters/mbfilter_iso2022_jp_ms.dep -MT libmbfl/filters/mbfilter_iso2022_jp_ms.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_iso2022_jp_ms.o
2025-Oct-06 02:23:33.429805
#9 18.79 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_iso2022jp_mobile.c -o libmbfl/filters/mbfilter_iso2022jp_mobile.lo  -MMD -MF libmbfl/filters/mbfilter_iso2022jp_mobile.dep -MT libmbfl/filters/mbfilter_iso2022jp_mobile.lo
2025-Oct-06 02:23:33.429805
#9 18.84  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_iso2022jp_mobile.c -MMD -MF libmbfl/filters/mbfilter_iso2022jp_mobile.dep -MT libmbfl/filters/mbfilter_iso2022jp_mobile.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_iso2022jp_mobile.o
2025-Oct-06 02:23:33.429805
#9 19.46 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_iso2022_kr.c -o libmbfl/filters/mbfilter_iso2022_kr.lo  -MMD -MF libmbfl/filters/mbfilter_iso2022_kr.dep -MT libmbfl/filters/mbfilter_iso2022_kr.lo
2025-Oct-06 02:23:33.429805
#9 19.51  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_iso2022_kr.c -MMD -MF libmbfl/filters/mbfilter_iso2022_kr.dep -MT libmbfl/filters/mbfilter_iso2022_kr.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_iso2022_kr.o
2025-Oct-06 02:23:33.429805
#9 19.75 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_jis.c -o libmbfl/filters/mbfilter_jis.lo  -MMD -MF libmbfl/filters/mbfilter_jis.dep -MT libmbfl/filters/mbfilter_jis.lo
2025-Oct-06 02:23:33.429805
#9 19.80  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_jis.c -MMD -MF libmbfl/filters/mbfilter_jis.dep -MT libmbfl/filters/mbfilter_jis.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_jis.o
2025-Oct-06 02:23:33.429805
#9 20.27 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_qprint.c -o libmbfl/filters/mbfilter_qprint.lo  -MMD -MF libmbfl/filters/mbfilter_qprint.dep -MT libmbfl/filters/mbfilter_qprint.lo
2025-Oct-06 02:23:33.429805
#9 20.31  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_qprint.c -MMD -MF libmbfl/filters/mbfilter_qprint.dep -MT libmbfl/filters/mbfilter_qprint.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_qprint.o
2025-Oct-06 02:23:33.429805
#9 20.51 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_singlebyte.c -o libmbfl/filters/mbfilter_singlebyte.lo  -MMD -MF libmbfl/filters/mbfilter_singlebyte.dep -MT libmbfl/filters/mbfilter_singlebyte.lo
2025-Oct-06 02:23:33.429805
#9 20.58  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_singlebyte.c -MMD -MF libmbfl/filters/mbfilter_singlebyte.dep -MT libmbfl/filters/mbfilter_singlebyte.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_singlebyte.o
2025-Oct-06 02:23:33.429805
#9 21.41 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_sjis.c -o libmbfl/filters/mbfilter_sjis.lo  -MMD -MF libmbfl/filters/mbfilter_sjis.dep -MT libmbfl/filters/mbfilter_sjis.lo
2025-Oct-06 02:23:33.429805
#9 21.46  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_sjis.c -MMD -MF libmbfl/filters/mbfilter_sjis.dep -MT libmbfl/filters/mbfilter_sjis.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_sjis.o
2025-Oct-06 02:23:33.429805
#9 21.75 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_sjis_mobile.c -o libmbfl/filters/mbfilter_sjis_mobile.lo  -MMD -MF libmbfl/filters/mbfilter_sjis_mobile.dep -MT libmbfl/filters/mbfilter_sjis_mobile.lo
2025-Oct-06 02:23:33.429805
#9 21.80  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_sjis_mobile.c -MMD -MF libmbfl/filters/mbfilter_sjis_mobile.dep -MT libmbfl/filters/mbfilter_sjis_mobile.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_sjis_mobile.o
2025-Oct-06 02:23:33.429805
#9 23.27 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_sjis_mac.c -o libmbfl/filters/mbfilter_sjis_mac.lo  -MMD -MF libmbfl/filters/mbfilter_sjis_mac.dep -MT libmbfl/filters/mbfilter_sjis_mac.lo
2025-Oct-06 02:23:33.429805
#9 23.31  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_sjis_mac.c -MMD -MF libmbfl/filters/mbfilter_sjis_mac.dep -MT libmbfl/filters/mbfilter_sjis_mac.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_sjis_mac.o
2025-Oct-06 02:23:33.429805
#9 24.07 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_sjis_2004.c -o libmbfl/filters/mbfilter_sjis_2004.lo  -MMD -MF libmbfl/filters/mbfilter_sjis_2004.dep -MT libmbfl/filters/mbfilter_sjis_2004.lo
2025-Oct-06 02:23:33.429805
#9 24.12  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_sjis_2004.c -MMD -MF libmbfl/filters/mbfilter_sjis_2004.dep -MT libmbfl/filters/mbfilter_sjis_2004.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_sjis_2004.o
2025-Oct-06 02:23:33.429805
#9 24.88 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_ucs2.c -o libmbfl/filters/mbfilter_ucs2.lo  -MMD -MF libmbfl/filters/mbfilter_ucs2.dep -MT libmbfl/filters/mbfilter_ucs2.lo
2025-Oct-06 02:23:33.429805
#9 24.94  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_ucs2.c -MMD -MF libmbfl/filters/mbfilter_ucs2.dep -MT libmbfl/filters/mbfilter_ucs2.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_ucs2.o
2025-Oct-06 02:23:33.429805
#9 25.11 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_ucs4.c -o libmbfl/filters/mbfilter_ucs4.lo  -MMD -MF libmbfl/filters/mbfilter_ucs4.dep -MT libmbfl/filters/mbfilter_ucs4.lo
2025-Oct-06 02:23:33.429805
#9 25.16  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_ucs4.c -MMD -MF libmbfl/filters/mbfilter_ucs4.dep -MT libmbfl/filters/mbfilter_ucs4.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_ucs4.o
2025-Oct-06 02:23:33.429805
#9 25.34 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_uhc.c -o libmbfl/filters/mbfilter_uhc.lo  -MMD -MF libmbfl/filters/mbfilter_uhc.dep -MT libmbfl/filters/mbfilter_uhc.lo
2025-Oct-06 02:23:33.429805
#9 25.39  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_uhc.c -MMD -MF libmbfl/filters/mbfilter_uhc.dep -MT libmbfl/filters/mbfilter_uhc.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_uhc.o
2025-Oct-06 02:23:33.429805
#9 25.67 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_utf16.c -o libmbfl/filters/mbfilter_utf16.lo  -MMD -MF libmbfl/filters/mbfilter_utf16.dep -MT libmbfl/filters/mbfilter_utf16.lo
2025-Oct-06 02:23:33.429805
#9 25.72  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_utf16.c -MMD -MF libmbfl/filters/mbfilter_utf16.dep -MT libmbfl/filters/mbfilter_utf16.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_utf16.o
2025-Oct-06 02:23:33.429805
#9 25.96 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_utf32.c -o libmbfl/filters/mbfilter_utf32.lo  -MMD -MF libmbfl/filters/mbfilter_utf32.dep -MT libmbfl/filters/mbfilter_utf32.lo
2025-Oct-06 02:23:33.429805
#9 26.01  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_utf32.c -MMD -MF libmbfl/filters/mbfilter_utf32.dep -MT libmbfl/filters/mbfilter_utf32.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_utf32.o
2025-Oct-06 02:23:33.429805
#9 26.18 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_utf7.c -o libmbfl/filters/mbfilter_utf7.lo  -MMD -MF libmbfl/filters/mbfilter_utf7.dep -MT libmbfl/filters/mbfilter_utf7.lo
2025-Oct-06 02:23:33.429805
#9 26.23  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_utf7.c -MMD -MF libmbfl/filters/mbfilter_utf7.dep -MT libmbfl/filters/mbfilter_utf7.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_utf7.o
2025-Oct-06 02:23:33.429805
#9 26.69 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_utf7imap.c -o libmbfl/filters/mbfilter_utf7imap.lo  -MMD -MF libmbfl/filters/mbfilter_utf7imap.dep -MT libmbfl/filters/mbfilter_utf7imap.lo
2025-Oct-06 02:23:33.429805
#9 26.74  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_utf7imap.c -MMD -MF libmbfl/filters/mbfilter_utf7imap.dep -MT libmbfl/filters/mbfilter_utf7imap.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_utf7imap.o
2025-Oct-06 02:23:33.429805
#9 27.16 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_utf8.c -o libmbfl/filters/mbfilter_utf8.lo  -MMD -MF libmbfl/filters/mbfilter_utf8.dep -MT libmbfl/filters/mbfilter_utf8.lo
2025-Oct-06 02:23:33.429805
#9 27.21  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_utf8.c -MMD -MF libmbfl/filters/mbfilter_utf8.dep -MT libmbfl/filters/mbfilter_utf8.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_utf8.o
2025-Oct-06 02:23:33.429805
#9 27.40 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_utf8_mobile.c -o libmbfl/filters/mbfilter_utf8_mobile.lo  -MMD -MF libmbfl/filters/mbfilter_utf8_mobile.dep -MT libmbfl/filters/mbfilter_utf8_mobile.lo
2025-Oct-06 02:23:33.429805
#9 27.45  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_utf8_mobile.c -MMD -MF libmbfl/filters/mbfilter_utf8_mobile.dep -MT libmbfl/filters/mbfilter_utf8_mobile.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_utf8_mobile.o
2025-Oct-06 02:23:33.429805
#9 27.94 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_uuencode.c -o libmbfl/filters/mbfilter_uuencode.lo  -MMD -MF libmbfl/filters/mbfilter_uuencode.dep -MT libmbfl/filters/mbfilter_uuencode.lo
2025-Oct-06 02:23:33.429805
#9 27.99  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/filters/mbfilter_uuencode.c -MMD -MF libmbfl/filters/mbfilter_uuencode.dep -MT libmbfl/filters/mbfilter_uuencode.lo  -fPIC -DPIC -o libmbfl/filters/.libs/mbfilter_uuencode.o
2025-Oct-06 02:23:33.429805
#9 28.18 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfilter.c -o libmbfl/mbfl/mbfilter.lo  -MMD -MF libmbfl/mbfl/mbfilter.dep -MT libmbfl/mbfl/mbfilter.lo
2025-Oct-06 02:23:33.429805
#9 28.23 mkdir libmbfl/mbfl/.libs
2025-Oct-06 02:23:33.429805
#9 28.23  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfilter.c -MMD -MF libmbfl/mbfl/mbfilter.dep -MT libmbfl/mbfl/mbfilter.lo  -fPIC -DPIC -o libmbfl/mbfl/.libs/mbfilter.o
2025-Oct-06 02:23:33.429805
#9 28.73 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfilter_8bit.c -o libmbfl/mbfl/mbfilter_8bit.lo  -MMD -MF libmbfl/mbfl/mbfilter_8bit.dep -MT libmbfl/mbfl/mbfilter_8bit.lo
2025-Oct-06 02:23:33.429805
#9 28.78  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfilter_8bit.c -MMD -MF libmbfl/mbfl/mbfilter_8bit.dep -MT libmbfl/mbfl/mbfilter_8bit.lo  -fPIC -DPIC -o libmbfl/mbfl/.libs/mbfilter_8bit.o
2025-Oct-06 02:23:33.429805
#9 28.89 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfilter_pass.c -o libmbfl/mbfl/mbfilter_pass.lo  -MMD -MF libmbfl/mbfl/mbfilter_pass.dep -MT libmbfl/mbfl/mbfilter_pass.lo
2025-Oct-06 02:23:33.429805
#9 28.94  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfilter_pass.c -MMD -MF libmbfl/mbfl/mbfilter_pass.dep -MT libmbfl/mbfl/mbfilter_pass.lo  -fPIC -DPIC -o libmbfl/mbfl/.libs/mbfilter_pass.o
2025-Oct-06 02:23:33.429805
#9 29.03 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfilter_wchar.c -o libmbfl/mbfl/mbfilter_wchar.lo  -MMD -MF libmbfl/mbfl/mbfilter_wchar.dep -MT libmbfl/mbfl/mbfilter_wchar.lo
2025-Oct-06 02:23:33.429805
#9 29.08  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfilter_wchar.c -MMD -MF libmbfl/mbfl/mbfilter_wchar.dep -MT libmbfl/mbfl/mbfilter_wchar.lo  -fPIC -DPIC -o libmbfl/mbfl/.libs/mbfilter_wchar.o
2025-Oct-06 02:23:33.429805
#9 29.16 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfl_convert.c -o libmbfl/mbfl/mbfl_convert.lo  -MMD -MF libmbfl/mbfl/mbfl_convert.dep -MT libmbfl/mbfl/mbfl_convert.lo
2025-Oct-06 02:23:33.429805
#9 29.21  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfl_convert.c -MMD -MF libmbfl/mbfl/mbfl_convert.dep -MT libmbfl/mbfl/mbfl_convert.lo  -fPIC -DPIC -o libmbfl/mbfl/.libs/mbfl_convert.o
2025-Oct-06 02:23:33.429805
#9 29.50 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfl_encoding.c -o libmbfl/mbfl/mbfl_encoding.lo  -MMD -MF libmbfl/mbfl/mbfl_encoding.dep -MT libmbfl/mbfl/mbfl_encoding.lo
2025-Oct-06 02:23:33.429805
#9 29.56  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfl_encoding.c -MMD -MF libmbfl/mbfl/mbfl_encoding.dep -MT libmbfl/mbfl/mbfl_encoding.lo  -fPIC -DPIC -o libmbfl/mbfl/.libs/mbfl_encoding.o
2025-Oct-06 02:23:33.429805
#9 29.67 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfl_filter_output.c -o libmbfl/mbfl/mbfl_filter_output.lo  -MMD -MF libmbfl/mbfl/mbfl_filter_output.dep -MT libmbfl/mbfl/mbfl_filter_output.lo
2025-Oct-06 02:23:33.429805
#9 29.71  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfl_filter_output.c -MMD -MF libmbfl/mbfl/mbfl_filter_output.dep -MT libmbfl/mbfl/mbfl_filter_output.lo  -fPIC -DPIC -o libmbfl/mbfl/.libs/mbfl_filter_output.o
2025-Oct-06 02:23:33.429805
#9 29.80 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfl_language.c -o libmbfl/mbfl/mbfl_language.lo  -MMD -MF libmbfl/mbfl/mbfl_language.dep -MT libmbfl/mbfl/mbfl_language.lo
2025-Oct-06 02:23:33.429805
#9 29.85  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfl_language.c -MMD -MF libmbfl/mbfl/mbfl_language.dep -MT libmbfl/mbfl/mbfl_language.lo  -fPIC -DPIC -o libmbfl/mbfl/.libs/mbfl_language.o
2025-Oct-06 02:23:33.429805
#9 29.95 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfl_memory_device.c -o libmbfl/mbfl/mbfl_memory_device.lo  -MMD -MF libmbfl/mbfl/mbfl_memory_device.dep -MT libmbfl/mbfl/mbfl_memory_device.lo
2025-Oct-06 02:23:33.429805
#9 30.01  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfl_memory_device.c -MMD -MF libmbfl/mbfl/mbfl_memory_device.dep -MT libmbfl/mbfl/mbfl_memory_device.lo  -fPIC -DPIC -o libmbfl/mbfl/.libs/mbfl_memory_device.o
2025-Oct-06 02:23:33.429805
#9 30.13 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfl_string.c -o libmbfl/mbfl/mbfl_string.lo  -MMD -MF libmbfl/mbfl/mbfl_string.dep -MT libmbfl/mbfl/mbfl_string.lo
2025-Oct-06 02:23:33.429805
#9 30.18  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/mbfl/mbfl_string.c -MMD -MF libmbfl/mbfl/mbfl_string.dep -MT libmbfl/mbfl/mbfl_string.lo  -fPIC -DPIC -o libmbfl/mbfl/.libs/mbfl_string.o
2025-Oct-06 02:23:33.429805
#9 30.28 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_de.c -o libmbfl/nls/nls_de.lo  -MMD -MF libmbfl/nls/nls_de.dep -MT libmbfl/nls/nls_de.lo
2025-Oct-06 02:23:33.429805
#9 30.33 mkdir libmbfl/nls/.libs
2025-Oct-06 02:23:33.429805
#9 30.33  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_de.c -MMD -MF libmbfl/nls/nls_de.dep -MT libmbfl/nls/nls_de.lo  -fPIC -DPIC -o libmbfl/nls/.libs/nls_de.o
2025-Oct-06 02:23:33.429805
#9 30.41 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_en.c -o libmbfl/nls/nls_en.lo  -MMD -MF libmbfl/nls/nls_en.dep -MT libmbfl/nls/nls_en.lo
2025-Oct-06 02:23:33.429805
#9 30.46  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_en.c -MMD -MF libmbfl/nls/nls_en.dep -MT libmbfl/nls/nls_en.lo  -fPIC -DPIC -o libmbfl/nls/.libs/nls_en.o
2025-Oct-06 02:23:33.429805
#9 30.54 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_ja.c -o libmbfl/nls/nls_ja.lo  -MMD -MF libmbfl/nls/nls_ja.dep -MT libmbfl/nls/nls_ja.lo
2025-Oct-06 02:23:33.429805
#9 30.59  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_ja.c -MMD -MF libmbfl/nls/nls_ja.dep -MT libmbfl/nls/nls_ja.lo  -fPIC -DPIC -o libmbfl/nls/.libs/nls_ja.o
2025-Oct-06 02:23:33.429805
#9 30.67 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_kr.c -o libmbfl/nls/nls_kr.lo  -MMD -MF libmbfl/nls/nls_kr.dep -MT libmbfl/nls/nls_kr.lo
2025-Oct-06 02:23:33.429805
#9 30.73  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_kr.c -MMD -MF libmbfl/nls/nls_kr.dep -MT libmbfl/nls/nls_kr.lo  -fPIC -DPIC -o libmbfl/nls/.libs/nls_kr.o
2025-Oct-06 02:23:33.429805
#9 30.81 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_neutral.c -o libmbfl/nls/nls_neutral.lo  -MMD -MF libmbfl/nls/nls_neutral.dep -MT libmbfl/nls/nls_neutral.lo
2025-Oct-06 02:23:33.429805
#9 30.86  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_neutral.c -MMD -MF libmbfl/nls/nls_neutral.dep -MT libmbfl/nls/nls_neutral.lo  -fPIC -DPIC -o libmbfl/nls/.libs/nls_neutral.o
2025-Oct-06 02:23:33.429805
#9 30.94 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_ru.c -o libmbfl/nls/nls_ru.lo  -MMD -MF libmbfl/nls/nls_ru.dep -MT libmbfl/nls/nls_ru.lo
2025-Oct-06 02:23:33.429805
#9 30.99  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_ru.c -MMD -MF libmbfl/nls/nls_ru.dep -MT libmbfl/nls/nls_ru.lo  -fPIC -DPIC -o libmbfl/nls/.libs/nls_ru.o
2025-Oct-06 02:23:33.429805
#9 31.08 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_uni.c -o libmbfl/nls/nls_uni.lo  -MMD -MF libmbfl/nls/nls_uni.dep -MT libmbfl/nls/nls_uni.lo
2025-Oct-06 02:23:33.429805
#9 31.13  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_uni.c -MMD -MF libmbfl/nls/nls_uni.dep -MT libmbfl/nls/nls_uni.lo  -fPIC -DPIC -o libmbfl/nls/.libs/nls_uni.o
2025-Oct-06 02:23:33.429805
#9 31.21 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_zh.c -o libmbfl/nls/nls_zh.lo  -MMD -MF libmbfl/nls/nls_zh.dep -MT libmbfl/nls/nls_zh.lo
2025-Oct-06 02:23:33.429805
#9 31.26  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_zh.c -MMD -MF libmbfl/nls/nls_zh.dep -MT libmbfl/nls/nls_zh.lo  -fPIC -DPIC -o libmbfl/nls/.libs/nls_zh.o
2025-Oct-06 02:23:33.429805
#9 31.34 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_hy.c -o libmbfl/nls/nls_hy.lo  -MMD -MF libmbfl/nls/nls_hy.dep -MT libmbfl/nls/nls_hy.lo
2025-Oct-06 02:23:33.429805
#9 31.39  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_hy.c -MMD -MF libmbfl/nls/nls_hy.dep -MT libmbfl/nls/nls_hy.lo  -fPIC -DPIC -o libmbfl/nls/.libs/nls_hy.o
2025-Oct-06 02:23:33.429805
#9 31.47 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_tr.c -o libmbfl/nls/nls_tr.lo  -MMD -MF libmbfl/nls/nls_tr.dep -MT libmbfl/nls/nls_tr.lo
2025-Oct-06 02:23:33.429805
#9 31.53  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_tr.c -MMD -MF libmbfl/nls/nls_tr.dep -MT libmbfl/nls/nls_tr.lo  -fPIC -DPIC -o libmbfl/nls/.libs/nls_tr.o
2025-Oct-06 02:23:33.429805
#9 31.61 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE    -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_ua.c -o libmbfl/nls/nls_ua.lo  -MMD -MF libmbfl/nls/nls_ua.dep -MT libmbfl/nls/nls_ua.lo
2025-Oct-06 02:23:33.429805
#9 31.66  cc -I. -I/usr/src/php/ext/mbstring -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DONIG_ESCAPE_UCHAR_COLLISION=1 -DUChar=OnigUChar -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/mbstring/libmbfl/nls/nls_ua.c -MMD -MF libmbfl/nls/nls_ua.dep -MT libmbfl/nls/nls_ua.lo  -fPIC -DPIC -o libmbfl/nls/.libs/nls_ua.o
2025-Oct-06 02:23:33.429805
#9 31.74 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=link cc -shared -I/usr/src/php/ext/mbstring/include -I/usr/src/php/ext/mbstring/main -I/usr/src/php/ext/mbstring -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/src/php/ext/mbstring/libmbfl -I/usr/src/php/ext/mbstring/libmbfl/mbfl  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE  -Wl,-O1 -pie  -o mbstring.la -export-dynamic -avoid-version -prefer-pic -module -rpath /usr/src/php/ext/mbstring/modules  mbstring.lo php_unicode.lo mb_gpc.lo php_mbregex.lo libmbfl/filters/html_entities.lo libmbfl/filters/mbfilter_7bit.lo libmbfl/filters/mbfilter_base64.lo libmbfl/filters/mbfilter_big5.lo libmbfl/filters/mbfilter_cp5022x.lo libmbfl/filters/mbfilter_cp51932.lo libmbfl/filters/mbfilter_cp932.lo libmbfl/filters/mbfilter_cp936.lo libmbfl/filters/mbfilter_gb18030.lo libmbfl/filters/mbfilter_euc_cn.lo libmbfl/filters/mbfilter_euc_jp.lo libmbfl/filters/mbfilter_euc_jp_win.lo libmbfl/filters/mbfilter_euc_kr.lo libmbfl/filters/mbfilter_euc_tw.lo libmbfl/filters/mbfilter_htmlent.lo libmbfl/filters/mbfilter_hz.lo libmbfl/filters/mbfilter_iso2022_jp_ms.lo libmbfl/filters/mbfilter_iso2022jp_mobile.lo libmbfl/filters/mbfilter_iso2022_kr.lo libmbfl/filters/mbfilter_jis.lo libmbfl/filters/mbfilter_qprint.lo libmbfl/filters/mbfilter_singlebyte.lo libmbfl/filters/mbfilter_sjis.lo libmbfl/filters/mbfilter_sjis_mobile.lo libmbfl/filters/mbfilter_sjis_mac.lo libmbfl/filters/mbfilter_sjis_2004.lo libmbfl/filters/mbfilter_ucs2.lo libmbfl/filters/mbfilter_ucs4.lo libmbfl/filters/mbfilter_uhc.lo libmbfl/filters/mbfilter_utf16.lo libmbfl/filters/mbfilter_utf32.lo libmbfl/filters/mbfilter_utf7.lo libmbfl/filters/mbfilter_utf7imap.lo libmbfl/filters/mbfilter_utf8.lo libmbfl/filters/mbfilter_utf8_mobile.lo libmbfl/filters/mbfilter_uuencode.lo libmbfl/mbfl/mbfilter.lo libmbfl/mbfl/mbfilter_8bit.lo libmbfl/mbfl/mbfilter_pass.lo libmbfl/mbfl/mbfilter_wchar.lo libmbfl/mbfl/mbfl_convert.lo libmbfl/mbfl/mbfl_encoding.lo libmbfl/mbfl/mbfl_filter_output.lo libmbfl/mbfl/mbfl_language.lo libmbfl/mbfl/mbfl_memory_device.lo libmbfl/mbfl/mbfl_string.lo libmbfl/nls/nls_de.lo libmbfl/nls/nls_en.lo libmbfl/nls/nls_ja.lo libmbfl/nls/nls_kr.lo libmbfl/nls/nls_neutral.lo libmbfl/nls/nls_ru.lo libmbfl/nls/nls_uni.lo libmbfl/nls/nls_zh.lo libmbfl/nls/nls_hy.lo libmbfl/nls/nls_tr.lo libmbfl/nls/nls_ua.lo -lonig
2025-Oct-06 02:23:33.429805
#9 31.91 cc -shared  .libs/mbstring.o .libs/php_unicode.o .libs/mb_gpc.o .libs/php_mbregex.o libmbfl/filters/.libs/html_entities.o libmbfl/filters/.libs/mbfilter_7bit.o libmbfl/filters/.libs/mbfilter_base64.o libmbfl/filters/.libs/mbfilter_big5.o libmbfl/filters/.libs/mbfilter_cp5022x.o libmbfl/filters/.libs/mbfilter_cp51932.o libmbfl/filters/.libs/mbfilter_cp932.o libmbfl/filters/.libs/mbfilter_cp936.o libmbfl/filters/.libs/mbfilter_gb18030.o libmbfl/filters/.libs/mbfilter_euc_cn.o libmbfl/filters/.libs/mbfilter_euc_jp.o libmbfl/filters/.libs/mbfilter_euc_jp_win.o libmbfl/filters/.libs/mbfilter_euc_kr.o libmbfl/filters/.libs/mbfilter_euc_tw.o libmbfl/filters/.libs/mbfilter_htmlent.o libmbfl/filters/.libs/mbfilter_hz.o libmbfl/filters/.libs/mbfilter_iso2022_jp_ms.o libmbfl/filters/.libs/mbfilter_iso2022jp_mobile.o libmbfl/filters/.libs/mbfilter_iso2022_kr.o libmbfl/filters/.libs/mbfilter_jis.o libmbfl/filters/.libs/mbfilter_qprint.o libmbfl/filters/.libs/mbfilter_singlebyte.o libmbfl/filters/.libs/mbfilter_sjis.o libmbfl/filters/.libs/mbfilter_sjis_mobile.o libmbfl/filters/.libs/mbfilter_sjis_mac.o libmbfl/filters/.libs/mbfilter_sjis_2004.o libmbfl/filters/.libs/mbfilter_ucs2.o libmbfl/filters/.libs/mbfilter_ucs4.o libmbfl/filters/.libs/mbfilter_uhc.o libmbfl/filters/.libs/mbfilter_utf16.o libmbfl/filters/.libs/mbfilter_utf32.o libmbfl/filters/.libs/mbfilter_utf7.o libmbfl/filters/.libs/mbfilter_utf7imap.o libmbfl/filters/.libs/mbfilter_utf8.o libmbfl/filters/.libs/mbfilter_utf8_mobile.o libmbfl/filters/.libs/mbfilter_uuencode.o libmbfl/mbfl/.libs/mbfilter.o libmbfl/mbfl/.libs/mbfilter_8bit.o libmbfl/mbfl/.libs/mbfilter_pass.o libmbfl/mbfl/.libs/mbfilter_wchar.o libmbfl/mbfl/.libs/mbfl_convert.o libmbfl/mbfl/.libs/mbfl_encoding.o libmbfl/mbfl/.libs/mbfl_filter_output.o libmbfl/mbfl/.libs/mbfl_language.o libmbfl/mbfl/.libs/mbfl_memory_device.o libmbfl/mbfl/.libs/mbfl_string.o libmbfl/nls/.libs/nls_de.o libmbfl/nls/.libs/nls_en.o libmbfl/nls/.libs/nls_ja.o libmbfl/nls/.libs/nls_kr.o libmbfl/nls/.libs/nls_neutral.o libmbfl/nls/.libs/nls_ru.o libmbfl/nls/.libs/nls_uni.o libmbfl/nls/.libs/nls_zh.o libmbfl/nls/.libs/nls_hy.o libmbfl/nls/.libs/nls_tr.o libmbfl/nls/.libs/nls_ua.o  -lonig  -Wl,-O1 -Wl,-soname -Wl,mbstring.so -o .libs/mbstring.so
2025-Oct-06 02:23:33.429805
#9 31.95 creating mbstring.la
2025-Oct-06 02:23:33.429805
#9 31.95 (cd .libs && rm -f mbstring.la && ln -s ../mbstring.la mbstring.la)
2025-Oct-06 02:23:33.429805
#9 31.95 /bin/sh /usr/src/php/ext/mbstring/libtool --tag=CC --mode=install cp ./mbstring.la /usr/src/php/ext/mbstring/modules
2025-Oct-06 02:23:33.429805
#9 31.96 cp ./.libs/mbstring.so /usr/src/php/ext/mbstring/modules/mbstring.so
2025-Oct-06 02:23:33.429805
#9 31.97 cp ./.libs/mbstring.lai /usr/src/php/ext/mbstring/modules/mbstring.la
2025-Oct-06 02:23:33.429805
#9 31.98 PATH="$PATH:/sbin" ldconfig -n /usr/src/php/ext/mbstring/modules
2025-Oct-06 02:23:33.429805
#9 31.98 ----------------------------------------------------------------------
2025-Oct-06 02:23:33.429805
#9 31.98 Libraries have been installed in:
2025-Oct-06 02:23:33.429805
#9 31.98    /usr/src/php/ext/mbstring/modules
2025-Oct-06 02:23:33.429805
#9 31.98
2025-Oct-06 02:23:33.429805
#9 31.98 If you ever happen to want to link against installed libraries
2025-Oct-06 02:23:33.429805
#9 31.98 in a given directory, LIBDIR, you must either use libtool, and
2025-Oct-06 02:23:33.429805
#9 31.98 specify the full pathname of the library, or use the `-LLIBDIR'
2025-Oct-06 02:23:33.429805
#9 31.98 flag during linking and do at least one of the following:
2025-Oct-06 02:23:33.429805
#9 31.98    - add LIBDIR to the `LD_LIBRARY_PATH' environment variable
2025-Oct-06 02:23:33.429805
#9 31.98      during execution
2025-Oct-06 02:23:33.429805
#9 31.98    - add LIBDIR to the `LD_RUN_PATH' environment variable
2025-Oct-06 02:23:33.429805
#9 31.98      during linking
2025-Oct-06 02:23:33.429805
#9 31.98    - use the `-Wl,--rpath -Wl,LIBDIR' linker flag
2025-Oct-06 02:23:33.429805
#9 31.98
2025-Oct-06 02:23:33.429805
#9 31.98 See any operating system documentation about shared libraries for
2025-Oct-06 02:23:33.429805
#9 31.98 more information, such as the ld(1) and ld.so(8) manual pages.
2025-Oct-06 02:23:33.429805
#9 31.98 ----------------------------------------------------------------------
2025-Oct-06 02:23:33.429805
#9 31.98
2025-Oct-06 02:23:33.429805
#9 31.98 Build complete.
2025-Oct-06 02:23:33.429805
#9 31.98 Don't forget to run 'make test'.
2025-Oct-06 02:23:33.429805
#9 31.98
2025-Oct-06 02:23:33.429805
#9 31.99 + strip --strip-all modules/mbstring.so
2025-Oct-06 02:23:33.429805
#9 32.04 Installing shared extensions:     /usr/local/lib/php/extensions/no-debug-non-zts-20220829/
2025-Oct-06 02:23:33.429805
#9 32.38 Installing header files:          /usr/local/include/php/
2025-Oct-06 02:23:33.429805
#9 32.75
2025-Oct-06 02:23:33.429805
#9 32.75 warning: mbstring (mbstring) is already loaded!
2025-Oct-06 02:23:33.429805
#9 32.75
2025-Oct-06 02:23:33.429805
#9 32.77 find . -name \*.gcno -o -name \*.gcda | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 32.77 find . -name \*.lo -o -name \*.o -o -name \*.dep | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 32.78 find . -name \*.la -o -name \*.a | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 32.79 find . -name \*.so | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 32.79 find . -name .libs -a -type d|xargs rm -rf
2025-Oct-06 02:23:33.429805
#9 32.80 rm -f libphp.la      modules/* libs/*
2025-Oct-06 02:23:33.429805
#9 32.80 rm -f ext/opcache/jit/zend_jit_x86.c
2025-Oct-06 02:23:33.429805
#9 32.80 rm -f ext/opcache/jit/zend_jit_arm64.c
2025-Oct-06 02:23:33.429805
#9 32.80 rm -f ext/opcache/minilua
2025-Oct-06 02:23:33.429805
#9 32.83 Configuring for:
2025-Oct-06 02:23:33.429805
#9 32.83 PHP Api Version:         20220829
2025-Oct-06 02:23:33.429805
#9 32.83 Zend Module Api No:      20220829
2025-Oct-06 02:23:33.429805
#9 32.83 Zend Extension Api No:   420220829
2025-Oct-06 02:23:33.429805
#9 33.55 checking for grep that handles long lines and -e... /bin/grep
2025-Oct-06 02:23:33.429805
#9 33.59 checking for egrep... /bin/grep -E
2025-Oct-06 02:23:33.429805
#9 33.59 checking for a sed that does not truncate output... /bin/sed
2025-Oct-06 02:23:33.429805
#9 33.60 checking for pkg-config... /usr/bin/pkg-config
2025-Oct-06 02:23:33.429805
#9 33.60 checking pkg-config is at least version 0.9.0... yes
2025-Oct-06 02:23:33.429805
#9 33.60 checking for cc... cc
2025-Oct-06 02:23:33.429805
#9 33.62 checking whether the C compiler works... yes
2025-Oct-06 02:23:33.429805
#9 33.65 checking for C compiler default output file name... a.out
2025-Oct-06 02:23:33.429805
#9 33.65 checking for suffix of executables...
2025-Oct-06 02:23:33.429805
#9 33.69 checking whether we are cross compiling... no
2025-Oct-06 02:23:33.429805
#9 33.72 checking for suffix of object files... o
2025-Oct-06 02:23:33.429805
#9 33.74 checking whether the compiler supports GNU C... yes
2025-Oct-06 02:23:33.429805
#9 33.76 checking whether cc accepts -g... yes
2025-Oct-06 02:23:33.429805
#9 33.78 checking for cc option to enable C11 features... none needed
2025-Oct-06 02:23:33.429805
#9 33.84 checking how to run the C preprocessor... cc -E
2025-Oct-06 02:23:33.429805
#9 33.88 checking for egrep -e... (cached) /bin/grep -E
2025-Oct-06 02:23:33.429805
#9 33.88 checking for icc... no
2025-Oct-06 02:23:33.429805
#9 33.89 checking for suncc... no
2025-Oct-06 02:23:33.429805
#9 33.90 checking for system library directory... lib
2025-Oct-06 02:23:33.429805
#9 33.90 checking if compiler supports -Wl,-rpath,... yes
2025-Oct-06 02:23:33.429805
#9 33.94 checking build system type... x86_64-pc-linux-musl
2025-Oct-06 02:23:33.429805
#9 33.94 checking host system type... x86_64-pc-linux-musl
2025-Oct-06 02:23:33.429805
#9 33.94 checking target system type... x86_64-pc-linux-musl
2025-Oct-06 02:23:33.429805
#9 33.98 checking for PHP prefix... /usr/local
2025-Oct-06 02:23:33.429805
#9 33.98 checking for PHP includes... -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib
2025-Oct-06 02:23:33.429805
#9 33.98 checking for PHP extension directory... /usr/local/lib/php/extensions/no-debug-non-zts-20220829
2025-Oct-06 02:23:33.429805
#9 33.98 checking for PHP installed headers prefix... /usr/local/include/php
2025-Oct-06 02:23:33.429805
#9 33.98 checking if debug is enabled... no
2025-Oct-06 02:23:33.429805
#9 33.99 checking if zts is enabled... no
2025-Oct-06 02:23:33.429805
#9 34.00 checking for gawk... no
2025-Oct-06 02:23:33.429805
#9 34.00 checking for nawk... no
2025-Oct-06 02:23:33.429805
#9 34.00 checking for awk... awk
2025-Oct-06 02:23:33.429805
#9 34.00 checking if awk is broken... no
2025-Oct-06 02:23:33.429805
#9 34.01 checking whether to enable EXIF (metadata from images) support... yes, shared
2025-Oct-06 02:23:33.429805
#9 34.01 checking for a sed that does not truncate output... /bin/sed
2025-Oct-06 02:23:33.429805
#9 34.01 checking for ld used by cc... /usr/x86_64-alpine-linux-musl/bin/ld
2025-Oct-06 02:23:33.429805
#9 34.02 checking if the linker (/usr/x86_64-alpine-linux-musl/bin/ld) is GNU ld... yes
2025-Oct-06 02:23:33.429805
#9 34.02 checking for /usr/x86_64-alpine-linux-musl/bin/ld option to reload object files... -r
2025-Oct-06 02:23:33.429805
#9 34.02 checking for BSD-compatible nm... /usr/bin/nm -B
2025-Oct-06 02:23:33.429805
#9 34.02 checking whether ln -s works... yes
2025-Oct-06 02:23:33.429805
#9 34.02 checking how to recognize dependent libraries... pass_all
2025-Oct-06 02:23:33.429805
#9 34.04 checking for stdio.h... yes
2025-Oct-06 02:23:33.429805
#9 34.05 checking for stdlib.h... yes
2025-Oct-06 02:23:33.429805
#9 34.07 checking for string.h... yes
2025-Oct-06 02:23:33.429805
#9 34.08 checking for inttypes.h... yes
2025-Oct-06 02:23:33.429805
#9 34.10 checking for stdint.h... yes
2025-Oct-06 02:23:33.429805
#9 34.12 checking for strings.h... yes
2025-Oct-06 02:23:33.429805
#9 34.13 checking for sys/stat.h... yes
2025-Oct-06 02:23:33.429805
#9 34.16 checking for sys/types.h... yes
2025-Oct-06 02:23:33.429805
#9 34.17 checking for unistd.h... yes
2025-Oct-06 02:23:33.429805
#9 34.19 checking for dlfcn.h... yes
2025-Oct-06 02:23:33.429805
#9 34.21 checking the maximum length of command line arguments... 98304
2025-Oct-06 02:23:33.429805
#9 34.22 checking command to parse /usr/bin/nm -B output from cc object... ok
2025-Oct-06 02:23:33.429805
#9 34.27 checking for objdir... .libs
2025-Oct-06 02:23:33.429805
#9 34.27 checking for ar... ar
2025-Oct-06 02:23:33.429805
#9 34.27 checking for ranlib... ranlib
2025-Oct-06 02:23:33.429805
#9 34.27 checking for strip... strip
2025-Oct-06 02:23:33.429805
#9 34.31 checking if cc supports -fno-rtti -fno-exceptions... no
2025-Oct-06 02:23:33.429805
#9 34.33 checking for cc option to produce PIC... -fPIC
2025-Oct-06 02:23:33.429805
#9 34.33 checking if cc PIC flag -fPIC works... yes
2025-Oct-06 02:23:33.429805
#9 34.35 checking if cc static flag -static works... yes
2025-Oct-06 02:23:33.429805
#9 34.38 checking if cc supports -c -o file.o... yes
2025-Oct-06 02:23:33.429805
#9 34.40 checking whether the cc linker (/usr/x86_64-alpine-linux-musl/bin/ld -m elf_x86_64) supports shared libraries... yes
2025-Oct-06 02:23:33.429805
#9 34.41 checking whether -lc should be explicitly linked in... no
2025-Oct-06 02:23:33.429805
#9 34.43 checking dynamic linker characteristics... GNU/Linux ld.so
2025-Oct-06 02:23:33.429805
#9 34.43 checking how to hardcode library paths into programs... immediate
2025-Oct-06 02:23:33.429805
#9 34.43 checking whether stripping libraries is possible... yes
2025-Oct-06 02:23:33.429805
#9 34.44 checking if libtool supports shared libraries... yes
2025-Oct-06 02:23:33.429805
#9 34.44 checking whether to build shared libraries... yes
2025-Oct-06 02:23:33.429805
#9 34.44 checking whether to build static libraries... no
2025-Oct-06 02:23:33.429805
#9 34.51
2025-Oct-06 02:23:33.429805
#9 34.51 creating libtool
2025-Oct-06 02:23:33.429805
#9 34.55 appending configuration tag "CXX" to libtool
2025-Oct-06 02:23:33.429805
#9 34.60 configure: patching config.h.in
2025-Oct-06 02:23:33.429805
#9 34.60 configure: creating ./config.status
2025-Oct-06 02:23:33.429805
#9 34.63 config.status: creating config.h
2025-Oct-06 02:23:33.429805
#9 34.66 /bin/sh /usr/src/php/ext/exif/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/exif -I/usr/src/php/ext/exif/include -I/usr/src/php/ext/exif/main -I/usr/src/php/ext/exif -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/exif/exif.c -o exif.lo  -MMD -MF exif.dep -MT exif.lo
2025-Oct-06 02:23:33.429805
#9 34.71 mkdir .libs
2025-Oct-06 02:23:33.429805
#9 34.71  cc -I. -I/usr/src/php/ext/exif -I/usr/src/php/ext/exif/include -I/usr/src/php/ext/exif/main -I/usr/src/php/ext/exif -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/exif/exif.c -MMD -MF exif.dep -MT exif.lo  -fPIC -DPIC -o .libs/exif.o
2025-Oct-06 02:23:33.429805
#9 35.86 /bin/sh /usr/src/php/ext/exif/libtool --tag=CC --mode=link cc -shared -I/usr/src/php/ext/exif/include -I/usr/src/php/ext/exif/main -I/usr/src/php/ext/exif -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE  -Wl,-O1 -pie  -o exif.la -export-dynamic -avoid-version -prefer-pic -module -rpath /usr/src/php/ext/exif/modules  exif.lo
2025-Oct-06 02:23:33.429805
#9 35.91 cc -shared  .libs/exif.o   -Wl,-O1 -Wl,-soname -Wl,exif.so -o .libs/exif.so
2025-Oct-06 02:23:33.429805
#9 35.92 creating exif.la
2025-Oct-06 02:23:33.429805
#9 35.92 (cd .libs && rm -f exif.la && ln -s ../exif.la exif.la)
2025-Oct-06 02:23:33.429805
#9 35.93 /bin/sh /usr/src/php/ext/exif/libtool --tag=CC --mode=install cp ./exif.la /usr/src/php/ext/exif/modules
2025-Oct-06 02:23:33.429805
#9 35.94 cp ./.libs/exif.so /usr/src/php/ext/exif/modules/exif.so
2025-Oct-06 02:23:33.429805
#9 35.94 cp ./.libs/exif.lai /usr/src/php/ext/exif/modules/exif.la
2025-Oct-06 02:23:33.429805
#9 35.95 PATH="$PATH:/sbin" ldconfig -n /usr/src/php/ext/exif/modules
2025-Oct-06 02:23:33.429805
#9 35.95 ----------------------------------------------------------------------
2025-Oct-06 02:23:33.429805
#9 35.95 Libraries have been installed in:
2025-Oct-06 02:23:33.429805
#9 35.95    /usr/src/php/ext/exif/modules
2025-Oct-06 02:23:33.429805
#9 35.95
2025-Oct-06 02:23:33.429805
#9 35.95 If you ever happen to want to link against installed libraries
2025-Oct-06 02:23:33.429805
#9 35.95 in a given directory, LIBDIR, you must either use libtool, and
2025-Oct-06 02:23:33.429805
#9 35.95 specify the full pathname of the library, or use the `-LLIBDIR'
2025-Oct-06 02:23:33.429805
#9 35.95 flag during linking and do at least one of the following:
2025-Oct-06 02:23:33.429805
#9 35.95    - add LIBDIR to the `LD_LIBRARY_PATH' environment variable
2025-Oct-06 02:23:33.429805
#9 35.95      during execution
2025-Oct-06 02:23:33.429805
#9 35.95    - add LIBDIR to the `LD_RUN_PATH' environment variable
2025-Oct-06 02:23:33.429805
#9 35.95      during linking
2025-Oct-06 02:23:33.429805
#9 35.95    - use the `-Wl,--rpath -Wl,LIBDIR' linker flag
2025-Oct-06 02:23:33.429805
#9 35.95
2025-Oct-06 02:23:33.429805
#9 35.95 See any operating system documentation about shared libraries for
2025-Oct-06 02:23:33.429805
#9 35.95 more information, such as the ld(1) and ld.so(8) manual pages.
2025-Oct-06 02:23:33.429805
#9 35.95 ----------------------------------------------------------------------
2025-Oct-06 02:23:33.429805
#9 35.95
2025-Oct-06 02:23:33.429805
#9 35.95 Build complete.
2025-Oct-06 02:23:33.429805
#9 35.96 Don't forget to run 'make test'.
2025-Oct-06 02:23:33.429805
#9 35.96
2025-Oct-06 02:23:33.429805
#9 35.97 + strip --strip-all modules/exif.so
2025-Oct-06 02:23:33.429805
#9 35.99 Installing shared extensions:     /usr/local/lib/php/extensions/no-debug-non-zts-20220829/
2025-Oct-06 02:23:33.429805
#9 36.04 find . -name \*.gcno -o -name \*.gcda | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 36.05 find . -name \*.lo -o -name \*.o -o -name \*.dep | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 36.05 find . -name \*.la -o -name \*.a | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 36.05 find . -name \*.so | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 36.05 find . -name .libs -a -type d|xargs rm -rf
2025-Oct-06 02:23:33.429805
#9 36.06 rm -f libphp.la      modules/* libs/*
2025-Oct-06 02:23:33.429805
#9 36.06 rm -f ext/opcache/jit/zend_jit_x86.c
2025-Oct-06 02:23:33.429805
#9 36.06 rm -f ext/opcache/jit/zend_jit_arm64.c
2025-Oct-06 02:23:33.429805
#9 36.06 rm -f ext/opcache/minilua
2025-Oct-06 02:23:33.429805
#9 36.09 Configuring for:
2025-Oct-06 02:23:33.429805
#9 36.09 PHP Api Version:         20220829
2025-Oct-06 02:23:33.429805
#9 36.09 Zend Module Api No:      20220829
2025-Oct-06 02:23:33.429805
#9 36.09 Zend Extension Api No:   420220829
2025-Oct-06 02:23:33.429805
#9 36.84 checking for grep that handles long lines and -e... /bin/grep
2025-Oct-06 02:23:33.429805
#9 36.87 checking for egrep... /bin/grep -E
2025-Oct-06 02:23:33.429805
#9 36.87 checking for a sed that does not truncate output... /bin/sed
2025-Oct-06 02:23:33.429805
#9 36.89 checking for pkg-config... /usr/bin/pkg-config
2025-Oct-06 02:23:33.429805
#9 36.89 checking pkg-config is at least version 0.9.0... yes
2025-Oct-06 02:23:33.429805
#9 36.89 checking for cc... cc
2025-Oct-06 02:23:33.429805
#9 36.90 checking whether the C compiler works... yes
2025-Oct-06 02:23:33.429805
#9 36.94 checking for C compiler default output file name... a.out
2025-Oct-06 02:23:33.429805
#9 36.94 checking for suffix of executables...
2025-Oct-06 02:23:33.429805
#9 36.97 checking whether we are cross compiling... no
2025-Oct-06 02:23:33.429805
#9 37.00 checking for suffix of object files... o
2025-Oct-06 02:23:33.429805
#9 37.02 checking whether the compiler supports GNU C... yes
2025-Oct-06 02:23:33.429805
#9 37.04 checking whether cc accepts -g... yes
2025-Oct-06 02:23:33.429805
#9 37.07 checking for cc option to enable C11 features... none needed
2025-Oct-06 02:23:33.429805
#9 37.12 checking how to run the C preprocessor... cc -E
2025-Oct-06 02:23:33.429805
#9 37.17 checking for egrep -e... (cached) /bin/grep -E
2025-Oct-06 02:23:33.429805
#9 37.17 checking for icc... no
2025-Oct-06 02:23:33.429805
#9 37.18 checking for suncc... no
2025-Oct-06 02:23:33.429805
#9 37.19 checking for system library directory... lib
2025-Oct-06 02:23:33.429805
#9 37.19 checking if compiler supports -Wl,-rpath,... yes
2025-Oct-06 02:23:33.429805
#9 37.22 checking build system type... x86_64-pc-linux-musl
2025-Oct-06 02:23:33.429805
#9 37.23 checking host system type... x86_64-pc-linux-musl
2025-Oct-06 02:23:33.429805
#9 37.23 checking target system type... x86_64-pc-linux-musl
2025-Oct-06 02:23:33.429805
#9 37.27 checking for PHP prefix... /usr/local
2025-Oct-06 02:23:33.429805
#9 37.27 checking for PHP includes... -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib
2025-Oct-06 02:23:33.429805
#9 37.27 checking for PHP extension directory... /usr/local/lib/php/extensions/no-debug-non-zts-20220829
2025-Oct-06 02:23:33.429805
#9 37.27 checking for PHP installed headers prefix... /usr/local/include/php
2025-Oct-06 02:23:33.429805
#9 37.27 checking if debug is enabled... no
2025-Oct-06 02:23:33.429805
#9 37.28 checking if zts is enabled... no
2025-Oct-06 02:23:33.429805
#9 37.30 checking for gawk... no
2025-Oct-06 02:23:33.429805
#9 37.30 checking for nawk... no
2025-Oct-06 02:23:33.429805
#9 37.30 checking for awk... awk
2025-Oct-06 02:23:33.429805
#9 37.30 checking if awk is broken... no
2025-Oct-06 02:23:33.429805
#9 37.30 checking whether to enable pcntl support... yes, shared
2025-Oct-06 02:23:33.429805
#9 37.30 checking for fork... yes
2025-Oct-06 02:23:33.429805
#9 37.33 checking for waitpid... yes
2025-Oct-06 02:23:33.429805
#9 37.36 checking for sigaction... yes
2025-Oct-06 02:23:33.429805
#9 37.39 checking for getpriority... yes
2025-Oct-06 02:23:33.429805
#9 37.43 checking for setpriority... yes
2025-Oct-06 02:23:33.429805
#9 37.46 checking for wait3... yes
2025-Oct-06 02:23:33.429805
#9 37.50 checking for wait4... yes
2025-Oct-06 02:23:33.429805
#9 37.53 checking for sigwaitinfo... yes
2025-Oct-06 02:23:33.429805
#9 37.56 checking for sigtimedwait... yes
2025-Oct-06 02:23:33.429805
#9 37.59 checking for unshare... yes
2025-Oct-06 02:23:33.429805
#9 37.62 checking for rfork... no
2025-Oct-06 02:23:33.429805
#9 37.65 checking for forkx... no
2025-Oct-06 02:23:33.429805
#9 37.69 checking for siginfo_t... yes
2025-Oct-06 02:23:33.429805
#9 37.71 checking for a sed that does not truncate output... /bin/sed
2025-Oct-06 02:23:33.429805
#9 37.71 checking for ld used by cc... /usr/x86_64-alpine-linux-musl/bin/ld
2025-Oct-06 02:23:33.429805
#9 37.72 checking if the linker (/usr/x86_64-alpine-linux-musl/bin/ld) is GNU ld... yes
2025-Oct-06 02:23:33.429805
#9 37.72 checking for /usr/x86_64-alpine-linux-musl/bin/ld option to reload object files... -r
2025-Oct-06 02:23:33.429805
#9 37.72 checking for BSD-compatible nm... /usr/bin/nm -B
2025-Oct-06 02:23:33.429805
#9 37.72 checking whether ln -s works... yes
2025-Oct-06 02:23:33.429805
#9 37.72 checking how to recognize dependent libraries... pass_all
2025-Oct-06 02:23:33.429805
#9 37.74 checking for stdio.h... yes
2025-Oct-06 02:23:33.429805
#9 37.75 checking for stdlib.h... yes
2025-Oct-06 02:23:33.429805
#9 37.77 checking for string.h... yes
2025-Oct-06 02:23:33.429805
#9 37.78 checking for inttypes.h... yes
2025-Oct-06 02:23:33.429805
#9 37.80 checking for stdint.h... yes
2025-Oct-06 02:23:33.429805
#9 37.82 checking for strings.h... yes
2025-Oct-06 02:23:33.429805
#9 37.84 checking for sys/stat.h... yes
2025-Oct-06 02:23:33.429805
#9 37.85 checking for sys/types.h... yes
2025-Oct-06 02:23:33.429805
#9 37.87 checking for unistd.h... yes
2025-Oct-06 02:23:33.429805
#9 37.89 checking for dlfcn.h... yes
2025-Oct-06 02:23:33.429805
#9 37.91 checking the maximum length of command line arguments... 98304
2025-Oct-06 02:23:33.429805
#9 37.91 checking command to parse /usr/bin/nm -B output from cc object... ok
2025-Oct-06 02:23:33.429805
#9 37.96 checking for objdir... .libs
2025-Oct-06 02:23:33.429805
#9 37.97 checking for ar... ar
2025-Oct-06 02:23:33.429805
#9 37.97 checking for ranlib... ranlib
2025-Oct-06 02:23:33.429805
#9 37.97 checking for strip... strip
2025-Oct-06 02:23:33.429805
#9 38.01 checking if cc supports -fno-rtti -fno-exceptions... no
2025-Oct-06 02:23:33.429805
#9 38.02 checking for cc option to produce PIC... -fPIC
2025-Oct-06 02:23:33.429805
#9 38.03 checking if cc PIC flag -fPIC works... yes
2025-Oct-06 02:23:33.429805
#9 38.04 checking if cc static flag -static works... yes
2025-Oct-06 02:23:33.429805
#9 38.07 checking if cc supports -c -o file.o... yes
2025-Oct-06 02:23:33.429805
#9 38.09 checking whether the cc linker (/usr/x86_64-alpine-linux-musl/bin/ld -m elf_x86_64) supports shared libraries... yes
2025-Oct-06 02:23:33.429805
#9 38.10 checking whether -lc should be explicitly linked in... no
2025-Oct-06 02:23:33.429805
#9 38.12 checking dynamic linker characteristics... GNU/Linux ld.so
2025-Oct-06 02:23:33.429805
#9 38.13 checking how to hardcode library paths into programs... immediate
2025-Oct-06 02:23:33.429805
#9 38.13 checking whether stripping libraries is possible... yes
2025-Oct-06 02:23:33.429805
#9 38.13 checking if libtool supports shared libraries... yes
2025-Oct-06 02:23:33.429805
#9 38.13 checking whether to build shared libraries... yes
2025-Oct-06 02:23:33.429805
#9 38.13 checking whether to build static libraries... no
2025-Oct-06 02:23:33.429805
#9 38.19
2025-Oct-06 02:23:33.429805
#9 38.19 creating libtool
2025-Oct-06 02:23:33.429805
#9 38.23 appending configuration tag "CXX" to libtool
2025-Oct-06 02:23:33.429805
#9 38.28 configure: patching config.h.in
2025-Oct-06 02:23:33.429805
#9 38.28 configure: creating ./config.status
2025-Oct-06 02:23:33.429805
#9 38.31 config.status: creating config.h
2025-Oct-06 02:23:33.429805
#9 38.33 /bin/sh /usr/src/php/ext/pcntl/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/pcntl -I/usr/src/php/ext/pcntl/include -I/usr/src/php/ext/pcntl/main -I/usr/src/php/ext/pcntl -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -DHAVE_STRUCT_SIGINFO_T -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/pcntl/pcntl.c -o pcntl.lo  -MMD -MF pcntl.dep -MT pcntl.lo
2025-Oct-06 02:23:33.429805
#9 38.38 mkdir .libs
2025-Oct-06 02:23:33.429805
#9 38.38  cc -I. -I/usr/src/php/ext/pcntl -I/usr/src/php/ext/pcntl/include -I/usr/src/php/ext/pcntl/main -I/usr/src/php/ext/pcntl -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DHAVE_STRUCT_SIGINFO_T -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/pcntl/pcntl.c -MMD -MF pcntl.dep -MT pcntl.lo  -fPIC -DPIC -o .libs/pcntl.o
2025-Oct-06 02:23:33.429805
#9 38.98 /bin/sh /usr/src/php/ext/pcntl/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/pcntl -I/usr/src/php/ext/pcntl/include -I/usr/src/php/ext/pcntl/main -I/usr/src/php/ext/pcntl -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -DHAVE_STRUCT_SIGINFO_T -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/pcntl/php_signal.c -o php_signal.lo  -MMD -MF php_signal.dep -MT php_signal.lo
2025-Oct-06 02:23:33.429805
#9 39.03  cc -I. -I/usr/src/php/ext/pcntl -I/usr/src/php/ext/pcntl/include -I/usr/src/php/ext/pcntl/main -I/usr/src/php/ext/pcntl -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -DHAVE_STRUCT_SIGINFO_T -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/pcntl/php_signal.c -MMD -MF php_signal.dep -MT php_signal.lo  -fPIC -DPIC -o .libs/php_signal.o
2025-Oct-06 02:23:33.429805
#9 39.12 /bin/sh /usr/src/php/ext/pcntl/libtool --tag=CC --mode=link cc -shared -I/usr/src/php/ext/pcntl/include -I/usr/src/php/ext/pcntl/main -I/usr/src/php/ext/pcntl -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE  -Wl,-O1 -pie  -o pcntl.la -export-dynamic -avoid-version -prefer-pic -module -rpath /usr/src/php/ext/pcntl/modules  pcntl.lo php_signal.lo
2025-Oct-06 02:23:33.429805
#9 39.16 cc -shared  .libs/pcntl.o .libs/php_signal.o   -Wl,-O1 -Wl,-soname -Wl,pcntl.so -o .libs/pcntl.so
2025-Oct-06 02:23:33.429805
#9 39.17 creating pcntl.la
2025-Oct-06 02:23:33.429805
#9 39.18 (cd .libs && rm -f pcntl.la && ln -s ../pcntl.la pcntl.la)
2025-Oct-06 02:23:33.429805
#9 39.18 /bin/sh /usr/src/php/ext/pcntl/libtool --tag=CC --mode=install cp ./pcntl.la /usr/src/php/ext/pcntl/modules
2025-Oct-06 02:23:33.429805
#9 39.19 cp ./.libs/pcntl.so /usr/src/php/ext/pcntl/modules/pcntl.so
2025-Oct-06 02:23:33.429805
#9 39.19 cp ./.libs/pcntl.lai /usr/src/php/ext/pcntl/modules/pcntl.la
2025-Oct-06 02:23:33.429805
#9 39.20 PATH="$PATH:/sbin" ldconfig -n /usr/src/php/ext/pcntl/modules
2025-Oct-06 02:23:33.429805
#9 39.20 ----------------------------------------------------------------------
2025-Oct-06 02:23:33.429805
#9 39.20 Libraries have been installed in:
2025-Oct-06 02:23:33.429805
#9 39.20    /usr/src/php/ext/pcntl/modules
2025-Oct-06 02:23:33.429805
#9 39.20
2025-Oct-06 02:23:33.429805
#9 39.20 If you ever happen to want to link against installed libraries
2025-Oct-06 02:23:33.429805
#9 39.20 in a given directory, LIBDIR, you must either use libtool, and
2025-Oct-06 02:23:33.429805
#9 39.20 specify the full pathname of the library, or use the `-LLIBDIR'
2025-Oct-06 02:23:33.429805
#9 39.20 flag during linking and do at least one of the following:
2025-Oct-06 02:23:33.429805
#9 39.20    - add LIBDIR to the `LD_LIBRARY_PATH' environment variable
2025-Oct-06 02:23:33.429805
#9 39.20      during execution
2025-Oct-06 02:23:33.429805
#9 39.20    - add LIBDIR to the `LD_RUN_PATH' environment variable
2025-Oct-06 02:23:33.429805
#9 39.20      during linking
2025-Oct-06 02:23:33.429805
#9 39.20    - use the `-Wl,--rpath -Wl,LIBDIR' linker flag
2025-Oct-06 02:23:33.429805
#9 39.20
2025-Oct-06 02:23:33.429805
#9 39.20 See any operating system documentation about shared libraries for
2025-Oct-06 02:23:33.429805
#9 39.20 more information, such as the ld(1) and ld.so(8) manual pages.
2025-Oct-06 02:23:33.429805
#9 39.20 ----------------------------------------------------------------------
2025-Oct-06 02:23:33.429805
#9 39.20
2025-Oct-06 02:23:33.429805
#9 39.20 Build complete.
2025-Oct-06 02:23:33.429805
#9 39.21 Don't forget to run 'make test'.
2025-Oct-06 02:23:33.429805
#9 39.21
2025-Oct-06 02:23:33.429805
#9 39.22 + strip --strip-all modules/pcntl.so
2025-Oct-06 02:23:33.429805
#9 39.24 Installing shared extensions:     /usr/local/lib/php/extensions/no-debug-non-zts-20220829/
2025-Oct-06 02:23:33.429805
#9 39.29 find . -name \*.gcno -o -name \*.gcda | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 39.30 find . -name \*.lo -o -name \*.o -o -name \*.dep | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 39.30 find . -name \*.la -o -name \*.a | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 39.30 find . -name \*.so | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 39.30 find . -name .libs -a -type d|xargs rm -rf
2025-Oct-06 02:23:33.429805
#9 39.30 rm -f libphp.la      modules/* libs/*
2025-Oct-06 02:23:33.429805
#9 39.31 rm -f ext/opcache/jit/zend_jit_x86.c
2025-Oct-06 02:23:33.429805
#9 39.31 rm -f ext/opcache/jit/zend_jit_arm64.c
2025-Oct-06 02:23:33.429805
#9 39.31 rm -f ext/opcache/minilua
2025-Oct-06 02:23:33.429805
#9 39.33 Configuring for:
2025-Oct-06 02:23:33.429805
#9 39.33 PHP Api Version:         20220829
2025-Oct-06 02:23:33.429805
#9 39.33 Zend Module Api No:      20220829
2025-Oct-06 02:23:33.429805
#9 39.33 Zend Extension Api No:   420220829
2025-Oct-06 02:23:33.429805
#9 40.03 checking for grep that handles long lines and -e... /bin/grep
2025-Oct-06 02:23:33.429805
#9 40.07 checking for egrep... /bin/grep -E
2025-Oct-06 02:23:33.429805
#9 40.07 checking for a sed that does not truncate output... /bin/sed
2025-Oct-06 02:23:33.429805
#9 40.08 checking for pkg-config... /usr/bin/pkg-config
2025-Oct-06 02:23:33.429805
#9 40.08 checking pkg-config is at least version 0.9.0... yes
2025-Oct-06 02:23:33.429805
#9 40.08 checking for cc... cc
2025-Oct-06 02:23:33.429805
#9 40.10 checking whether the C compiler works... yes
2025-Oct-06 02:23:33.429805
#9 40.13 checking for C compiler default output file name... a.out
2025-Oct-06 02:23:33.429805
#9 40.13 checking for suffix of executables...
2025-Oct-06 02:23:33.429805
#9 40.16 checking whether we are cross compiling... no
2025-Oct-06 02:23:33.429805
#9 40.19 checking for suffix of object files... o
2025-Oct-06 02:23:33.429805
#9 40.21 checking whether the compiler supports GNU C... yes
2025-Oct-06 02:23:33.429805
#9 40.23 checking whether cc accepts -g... yes
2025-Oct-06 02:23:33.429805
#9 40.25 checking for cc option to enable C11 features... none needed
2025-Oct-06 02:23:33.429805
#9 40.30 checking how to run the C preprocessor... cc -E
2025-Oct-06 02:23:33.429805
#9 40.35 checking for egrep -e... (cached) /bin/grep -E
2025-Oct-06 02:23:33.429805
#9 40.35 checking for icc... no
2025-Oct-06 02:23:33.429805
#9 40.36 checking for suncc... no
2025-Oct-06 02:23:33.429805
#9 40.37 checking for system library directory... lib
2025-Oct-06 02:23:33.429805
#9 40.37 checking if compiler supports -Wl,-rpath,... yes
2025-Oct-06 02:23:33.429805
#9 40.40 checking build system type... x86_64-pc-linux-musl
2025-Oct-06 02:23:33.429805
#9 40.40 checking host system type... x86_64-pc-linux-musl
2025-Oct-06 02:23:33.429805
#9 40.40 checking target system type... x86_64-pc-linux-musl
2025-Oct-06 02:23:33.429805
#9 40.44 checking for PHP prefix... /usr/local
2025-Oct-06 02:23:33.429805
#9 40.44 checking for PHP includes... -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib
2025-Oct-06 02:23:33.429805
#9 40.44 checking for PHP extension directory... /usr/local/lib/php/extensions/no-debug-non-zts-20220829
2025-Oct-06 02:23:33.429805
#9 40.44 checking for PHP installed headers prefix... /usr/local/include/php
2025-Oct-06 02:23:33.429805
#9 40.44 checking if debug is enabled... no
2025-Oct-06 02:23:33.429805
#9 40.45 checking if zts is enabled... no
2025-Oct-06 02:23:33.429805
#9 40.47 checking for gawk... no
2025-Oct-06 02:23:33.429805
#9 40.47 checking for nawk... no
2025-Oct-06 02:23:33.429805
#9 40.47 checking for awk... awk
2025-Oct-06 02:23:33.429805
#9 40.47 checking if awk is broken... no
2025-Oct-06 02:23:33.429805
#9 40.47 checking whether to enable bc style precision math functions... yes, shared
2025-Oct-06 02:23:33.429805
#9 40.48 checking for a sed that does not truncate output... /bin/sed
2025-Oct-06 02:23:33.429805
#9 40.48 checking for ld used by cc... /usr/x86_64-alpine-linux-musl/bin/ld
2025-Oct-06 02:23:33.429805
#9 40.49 checking if the linker (/usr/x86_64-alpine-linux-musl/bin/ld) is GNU ld... yes
2025-Oct-06 02:23:33.429805
#9 40.49 checking for /usr/x86_64-alpine-linux-musl/bin/ld option to reload object files... -r
2025-Oct-06 02:23:33.429805
#9 40.49 checking for BSD-compatible nm... /usr/bin/nm -B
2025-Oct-06 02:23:33.429805
#9 40.49 checking whether ln -s works... yes
2025-Oct-06 02:23:33.429805
#9 40.49 checking how to recognize dependent libraries... pass_all
2025-Oct-06 02:23:33.429805
#9 40.51 checking for stdio.h... yes
2025-Oct-06 02:23:33.429805
#9 40.52 checking for stdlib.h... yes
2025-Oct-06 02:23:33.429805
#9 40.54 checking for string.h... yes
2025-Oct-06 02:23:33.429805
#9 40.56 checking for inttypes.h... yes
2025-Oct-06 02:23:33.429805
#9 40.58 checking for stdint.h... yes
2025-Oct-06 02:23:33.429805
#9 40.60 checking for strings.h... yes
2025-Oct-06 02:23:33.429805
#9 40.61 checking for sys/stat.h... yes
2025-Oct-06 02:23:33.429805
#9 40.63 checking for sys/types.h... yes
2025-Oct-06 02:23:33.429805
#9 40.65 checking for unistd.h... yes
2025-Oct-06 02:23:33.429805
#9 40.67 checking for dlfcn.h... yes
2025-Oct-06 02:23:33.429805
#9 40.69 checking the maximum length of command line arguments... 98304
2025-Oct-06 02:23:33.429805
#9 40.69 checking command to parse /usr/bin/nm -B output from cc object... ok
2025-Oct-06 02:23:33.429805
#9 40.74 checking for objdir... .libs
2025-Oct-06 02:23:33.429805
#9 40.75 checking for ar... ar
2025-Oct-06 02:23:33.429805
#9 40.75 checking for ranlib... ranlib
2025-Oct-06 02:23:33.429805
#9 40.75 checking for strip... strip
2025-Oct-06 02:23:33.429805
#9 40.79 checking if cc supports -fno-rtti -fno-exceptions... no
2025-Oct-06 02:23:33.429805
#9 40.81 checking for cc option to produce PIC... -fPIC
2025-Oct-06 02:23:33.429805
#9 40.81 checking if cc PIC flag -fPIC works... yes
2025-Oct-06 02:23:33.429805
#9 40.82 checking if cc static flag -static works... yes
2025-Oct-06 02:23:33.429805
#9 40.85 checking if cc supports -c -o file.o... yes
2025-Oct-06 02:23:33.429805
#9 40.87 checking whether the cc linker (/usr/x86_64-alpine-linux-musl/bin/ld -m elf_x86_64) supports shared libraries... yes
2025-Oct-06 02:23:33.429805
#9 40.89 checking whether -lc should be explicitly linked in... no
2025-Oct-06 02:23:33.429805
#9 40.91 checking dynamic linker characteristics... GNU/Linux ld.so
2025-Oct-06 02:23:33.429805
#9 40.91 checking how to hardcode library paths into programs... immediate
2025-Oct-06 02:23:33.429805
#9 40.91 checking whether stripping libraries is possible... yes
2025-Oct-06 02:23:33.429805
#9 40.92 checking if libtool supports shared libraries... yes
2025-Oct-06 02:23:33.429805
#9 40.92 checking whether to build shared libraries... yes
2025-Oct-06 02:23:33.429805
#9 40.92 checking whether to build static libraries... no
2025-Oct-06 02:23:33.429805
#9 40.99
2025-Oct-06 02:23:33.429805
#9 40.99 creating libtool
2025-Oct-06 02:23:33.429805
#9 41.03 appending configuration tag "CXX" to libtool
2025-Oct-06 02:23:33.429805
#9 41.08 configure: patching config.h.in
2025-Oct-06 02:23:33.429805
#9 41.08 configure: creating ./config.status
2025-Oct-06 02:23:33.429805
#9 41.11 config.status: creating config.h
2025-Oct-06 02:23:33.429805
#9 41.14 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/bcmath.c -o bcmath.lo  -MMD -MF bcmath.dep -MT bcmath.lo
2025-Oct-06 02:23:33.429805
#9 41.20 mkdir .libs
2025-Oct-06 02:23:33.429805
#9 41.20  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/bcmath.c -MMD -MF bcmath.dep -MT bcmath.lo  -fPIC -DPIC -o .libs/bcmath.o
2025-Oct-06 02:23:33.429805
#9 41.56 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/add.c -o libbcmath/src/add.lo  -MMD -MF libbcmath/src/add.dep -MT libbcmath/src/add.lo
2025-Oct-06 02:23:33.429805
#9 41.62 mkdir libbcmath/src/.libs
2025-Oct-06 02:23:33.429805
#9 41.62  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/add.c -MMD -MF libbcmath/src/add.dep -MT libbcmath/src/add.lo  -fPIC -DPIC -o libbcmath/src/.libs/add.o
2025-Oct-06 02:23:33.429805
#9 41.75 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/div.c -o libbcmath/src/div.lo  -MMD -MF libbcmath/src/div.dep -MT libbcmath/src/div.lo
2025-Oct-06 02:23:33.429805
#9 41.81  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/div.c -MMD -MF libbcmath/src/div.dep -MT libbcmath/src/div.lo  -fPIC -DPIC -o libbcmath/src/.libs/div.o
2025-Oct-06 02:23:33.429805
#9 41.99 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/init.c -o libbcmath/src/init.lo  -MMD -MF libbcmath/src/init.dep -MT libbcmath/src/init.lo
2025-Oct-06 02:23:33.429805
#9 42.04  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/init.c -MMD -MF libbcmath/src/init.dep -MT libbcmath/src/init.lo  -fPIC -DPIC -o libbcmath/src/.libs/init.o
2025-Oct-06 02:23:33.429805
#9 42.18 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/neg.c -o libbcmath/src/neg.lo  -MMD -MF libbcmath/src/neg.dep -MT libbcmath/src/neg.lo
2025-Oct-06 02:23:33.429805
#9 42.24  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/neg.c -MMD -MF libbcmath/src/neg.dep -MT libbcmath/src/neg.lo  -fPIC -DPIC -o libbcmath/src/.libs/neg.o
2025-Oct-06 02:23:33.429805
#9 42.36 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/raisemod.c -o libbcmath/src/raisemod.lo  -MMD -MF libbcmath/src/raisemod.dep -MT libbcmath/src/raisemod.lo
2025-Oct-06 02:23:33.429805
#9 42.42  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/raisemod.c -MMD -MF libbcmath/src/raisemod.dep -MT libbcmath/src/raisemod.lo  -fPIC -DPIC -o libbcmath/src/.libs/raisemod.o
2025-Oct-06 02:23:33.429805
#9 42.55 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/sub.c -o libbcmath/src/sub.lo  -MMD -MF libbcmath/src/sub.dep -MT libbcmath/src/sub.lo
2025-Oct-06 02:23:33.429805
#9 42.61  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/sub.c -MMD -MF libbcmath/src/sub.dep -MT libbcmath/src/sub.lo  -fPIC -DPIC -o libbcmath/src/.libs/sub.o
2025-Oct-06 02:23:33.429805
#9 42.74 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/compare.c -o libbcmath/src/compare.lo  -MMD -MF libbcmath/src/compare.dep -MT libbcmath/src/compare.lo
2025-Oct-06 02:23:33.429805
#9 42.79  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/compare.c -MMD -MF libbcmath/src/compare.dep -MT libbcmath/src/compare.lo  -fPIC -DPIC -o libbcmath/src/.libs/compare.o
2025-Oct-06 02:23:33.429805
#9 42.94 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/divmod.c -o libbcmath/src/divmod.lo  -MMD -MF libbcmath/src/divmod.dep -MT libbcmath/src/divmod.lo
2025-Oct-06 02:23:33.429805
#9 42.99  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/divmod.c -MMD -MF libbcmath/src/divmod.dep -MT libbcmath/src/divmod.lo  -fPIC -DPIC -o libbcmath/src/.libs/divmod.o
2025-Oct-06 02:23:33.429805
#9 43.12 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/int2num.c -o libbcmath/src/int2num.lo  -MMD -MF libbcmath/src/int2num.dep -MT libbcmath/src/int2num.lo
2025-Oct-06 02:23:33.429805
#9 43.18  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/int2num.c -MMD -MF libbcmath/src/int2num.dep -MT libbcmath/src/int2num.lo  -fPIC -DPIC -o libbcmath/src/.libs/int2num.o
2025-Oct-06 02:23:33.429805
#9 43.31 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/num2long.c -o libbcmath/src/num2long.lo  -MMD -MF libbcmath/src/num2long.dep -MT libbcmath/src/num2long.lo
2025-Oct-06 02:23:33.429805
#9 43.36  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/num2long.c -MMD -MF libbcmath/src/num2long.dep -MT libbcmath/src/num2long.lo  -fPIC -DPIC -o libbcmath/src/.libs/num2long.o
2025-Oct-06 02:23:33.429805
#9 43.50 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/output.c -o libbcmath/src/output.lo  -MMD -MF libbcmath/src/output.dep -MT libbcmath/src/output.lo
2025-Oct-06 02:23:33.429805
#9 43.55  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/output.c -MMD -MF libbcmath/src/output.dep -MT libbcmath/src/output.lo  -fPIC -DPIC -o libbcmath/src/.libs/output.o
2025-Oct-06 02:23:33.429805
#9 43.71 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/recmul.c -o libbcmath/src/recmul.lo  -MMD -MF libbcmath/src/recmul.dep -MT libbcmath/src/recmul.lo
2025-Oct-06 02:23:33.429805
#9 43.76  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/recmul.c -MMD -MF libbcmath/src/recmul.dep -MT libbcmath/src/recmul.lo  -fPIC -DPIC -o libbcmath/src/.libs/recmul.o
2025-Oct-06 02:23:33.429805
#9 43.95 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/sqrt.c -o libbcmath/src/sqrt.lo  -MMD -MF libbcmath/src/sqrt.dep -MT libbcmath/src/sqrt.lo
2025-Oct-06 02:23:33.429805
#9 44.00  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/sqrt.c -MMD -MF libbcmath/src/sqrt.dep -MT libbcmath/src/sqrt.lo  -fPIC -DPIC -o libbcmath/src/.libs/sqrt.o
2025-Oct-06 02:23:33.429805
#9 44.14 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/zero.c -o libbcmath/src/zero.lo  -MMD -MF libbcmath/src/zero.dep -MT libbcmath/src/zero.lo
2025-Oct-06 02:23:33.429805
#9 44.19  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/zero.c -MMD -MF libbcmath/src/zero.dep -MT libbcmath/src/zero.lo  -fPIC -DPIC -o libbcmath/src/.libs/zero.o
2025-Oct-06 02:23:33.429805
#9 44.33 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/debug.c -o libbcmath/src/debug.lo  -MMD -MF libbcmath/src/debug.dep -MT libbcmath/src/debug.lo
2025-Oct-06 02:23:33.429805
#9 44.39  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/debug.c -MMD -MF libbcmath/src/debug.dep -MT libbcmath/src/debug.lo  -fPIC -DPIC -o libbcmath/src/.libs/debug.o
2025-Oct-06 02:23:33.429805
#9 44.52 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/doaddsub.c -o libbcmath/src/doaddsub.lo  -MMD -MF libbcmath/src/doaddsub.dep -MT libbcmath/src/doaddsub.lo
2025-Oct-06 02:23:33.429805
#9 44.57  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/doaddsub.c -MMD -MF libbcmath/src/doaddsub.dep -MT libbcmath/src/doaddsub.lo  -fPIC -DPIC -o libbcmath/src/.libs/doaddsub.o
2025-Oct-06 02:23:33.429805
#9 44.75 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/nearzero.c -o libbcmath/src/nearzero.lo  -MMD -MF libbcmath/src/nearzero.dep -MT libbcmath/src/nearzero.lo
2025-Oct-06 02:23:33.429805
#9 44.80  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/nearzero.c -MMD -MF libbcmath/src/nearzero.dep -MT libbcmath/src/nearzero.lo  -fPIC -DPIC -o libbcmath/src/.libs/nearzero.o
2025-Oct-06 02:23:33.429805
#9 44.93 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/num2str.c -o libbcmath/src/num2str.lo  -MMD -MF libbcmath/src/num2str.dep -MT libbcmath/src/num2str.lo
2025-Oct-06 02:23:33.429805
#9 44.99  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/num2str.c -MMD -MF libbcmath/src/num2str.dep -MT libbcmath/src/num2str.lo  -fPIC -DPIC -o libbcmath/src/.libs/num2str.o
2025-Oct-06 02:23:33.429805
#9 45.20 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/raise.c -o libbcmath/src/raise.lo  -MMD -MF libbcmath/src/raise.dep -MT libbcmath/src/raise.lo
2025-Oct-06 02:23:33.429805
#9 45.25  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/raise.c -MMD -MF libbcmath/src/raise.dep -MT libbcmath/src/raise.lo  -fPIC -DPIC -o libbcmath/src/.libs/raise.o
2025-Oct-06 02:23:33.429805
#9 45.40 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/rmzero.c -o libbcmath/src/rmzero.lo  -MMD -MF libbcmath/src/rmzero.dep -MT libbcmath/src/rmzero.lo
2025-Oct-06 02:23:33.429805
#9 45.45  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/rmzero.c -MMD -MF libbcmath/src/rmzero.dep -MT libbcmath/src/rmzero.lo  -fPIC -DPIC -o libbcmath/src/.libs/rmzero.o
2025-Oct-06 02:23:33.429805
#9 45.58 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/str2num.c -o libbcmath/src/str2num.lo  -MMD -MF libbcmath/src/str2num.dep -MT libbcmath/src/str2num.lo
2025-Oct-06 02:23:33.429805
#9 45.63  cc -I. -I/usr/src/php/ext/bcmath -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/bcmath/libbcmath/src -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/bcmath/libbcmath/src/str2num.c -MMD -MF libbcmath/src/str2num.dep -MT libbcmath/src/str2num.lo  -fPIC -DPIC -o libbcmath/src/.libs/str2num.o
2025-Oct-06 02:23:33.429805
#9 45.78 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=link cc -shared -I/usr/src/php/ext/bcmath/include -I/usr/src/php/ext/bcmath/main -I/usr/src/php/ext/bcmath -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE  -Wl,-O1 -pie  -o bcmath.la -export-dynamic -avoid-version -prefer-pic -module -rpath /usr/src/php/ext/bcmath/modules  bcmath.lo libbcmath/src/add.lo libbcmath/src/div.lo libbcmath/src/init.lo libbcmath/src/neg.lo libbcmath/src/raisemod.lo libbcmath/src/sub.lo libbcmath/src/compare.lo libbcmath/src/divmod.lo libbcmath/src/int2num.lo libbcmath/src/num2long.lo libbcmath/src/output.lo libbcmath/src/recmul.lo libbcmath/src/sqrt.lo libbcmath/src/zero.lo libbcmath/src/debug.lo libbcmath/src/doaddsub.lo libbcmath/src/nearzero.lo libbcmath/src/num2str.lo libbcmath/src/raise.lo libbcmath/src/rmzero.lo libbcmath/src/str2num.lo
2025-Oct-06 02:23:33.429805
#9 45.87 cc -shared  .libs/bcmath.o libbcmath/src/.libs/add.o libbcmath/src/.libs/div.o libbcmath/src/.libs/init.o libbcmath/src/.libs/neg.o libbcmath/src/.libs/raisemod.o libbcmath/src/.libs/sub.o libbcmath/src/.libs/compare.o libbcmath/src/.libs/divmod.o libbcmath/src/.libs/int2num.o libbcmath/src/.libs/num2long.o libbcmath/src/.libs/output.o libbcmath/src/.libs/recmul.o libbcmath/src/.libs/sqrt.o libbcmath/src/.libs/zero.o libbcmath/src/.libs/debug.o libbcmath/src/.libs/doaddsub.o libbcmath/src/.libs/nearzero.o libbcmath/src/.libs/num2str.o libbcmath/src/.libs/raise.o libbcmath/src/.libs/rmzero.o libbcmath/src/.libs/str2num.o   -Wl,-O1 -Wl,-soname -Wl,bcmath.so -o .libs/bcmath.so
2025-Oct-06 02:23:33.429805
#9 45.88 creating bcmath.la
2025-Oct-06 02:23:33.429805
#9 45.89 (cd .libs && rm -f bcmath.la && ln -s ../bcmath.la bcmath.la)
2025-Oct-06 02:23:33.429805
#9 45.89 /bin/sh /usr/src/php/ext/bcmath/libtool --tag=CC --mode=install cp ./bcmath.la /usr/src/php/ext/bcmath/modules
2025-Oct-06 02:23:33.429805
#9 45.90 cp ./.libs/bcmath.so /usr/src/php/ext/bcmath/modules/bcmath.so
2025-Oct-06 02:23:33.429805
#9 45.90 cp ./.libs/bcmath.lai /usr/src/php/ext/bcmath/modules/bcmath.la
2025-Oct-06 02:23:33.429805
#9 45.91 PATH="$PATH:/sbin" ldconfig -n /usr/src/php/ext/bcmath/modules
2025-Oct-06 02:23:33.429805
#9 45.92 ----------------------------------------------------------------------
2025-Oct-06 02:23:33.429805
#9 45.92 Libraries have been installed in:
2025-Oct-06 02:23:33.429805
#9 45.92    /usr/src/php/ext/bcmath/modules
2025-Oct-06 02:23:33.429805
#9 45.92
2025-Oct-06 02:23:33.429805
#9 45.92 If you ever happen to want to link against installed libraries
2025-Oct-06 02:23:33.429805
#9 45.92 in a given directory, LIBDIR, you must either use libtool, and
2025-Oct-06 02:23:33.429805
#9 45.92 specify the full pathname of the library, or use the `-LLIBDIR'
2025-Oct-06 02:23:33.429805
#9 45.92 flag during linking and do at least one of the following:
2025-Oct-06 02:23:33.429805
#9 45.92    - add LIBDIR to the `LD_LIBRARY_PATH' environment variable
2025-Oct-06 02:23:33.429805
#9 45.92      during execution
2025-Oct-06 02:23:33.429805
#9 45.92    - add LIBDIR to the `LD_RUN_PATH' environment variable
2025-Oct-06 02:23:33.429805
#9 45.92      during linking
2025-Oct-06 02:23:33.429805
#9 45.92    - use the `-Wl,--rpath -Wl,LIBDIR' linker flag
2025-Oct-06 02:23:33.429805
#9 45.92
2025-Oct-06 02:23:33.429805
#9 45.92 See any operating system documentation about shared libraries for
2025-Oct-06 02:23:33.429805
#9 45.92 more information, such as the ld(1) and ld.so(8) manual pages.
2025-Oct-06 02:23:33.429805
#9 45.92 ----------------------------------------------------------------------
2025-Oct-06 02:23:33.429805
#9 45.92
2025-Oct-06 02:23:33.429805
#9 45.92 Build complete.
2025-Oct-06 02:23:33.429805
#9 45.92 Don't forget to run 'make test'.
2025-Oct-06 02:23:33.429805
#9 45.92
2025-Oct-06 02:23:33.429805
#9 45.93 + strip --strip-all modules/bcmath.so
2025-Oct-06 02:23:33.429805
#9 45.96 Installing shared extensions:     /usr/local/lib/php/extensions/no-debug-non-zts-20220829/
2025-Oct-06 02:23:33.429805
#9 46.03 find . -name \*.gcno -o -name \*.gcda | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 46.03 find . -name \*.lo -o -name \*.o -o -name \*.dep | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 46.03 find . -name \*.la -o -name \*.a | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 46.03 find . -name \*.so | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 46.04 find . -name .libs -a -type d|xargs rm -rf
2025-Oct-06 02:23:33.429805
#9 46.04 rm -f libphp.la      modules/* libs/*
2025-Oct-06 02:23:33.429805
#9 46.04 rm -f ext/opcache/jit/zend_jit_x86.c
2025-Oct-06 02:23:33.429805
#9 46.04 rm -f ext/opcache/jit/zend_jit_arm64.c
2025-Oct-06 02:23:33.429805
#9 46.04 rm -f ext/opcache/minilua
2025-Oct-06 02:23:33.429805
#9 46.07 Configuring for:
2025-Oct-06 02:23:33.429805
#9 46.07 PHP Api Version:         20220829
2025-Oct-06 02:23:33.429805
#9 46.07 Zend Module Api No:      20220829
2025-Oct-06 02:23:33.429805
#9 46.07 Zend Extension Api No:   420220829
2025-Oct-06 02:23:33.429805
#9 46.90 checking for grep that handles long lines and -e... /bin/grep
2025-Oct-06 02:23:33.429805
#9 46.94 checking for egrep... /bin/grep -E
2025-Oct-06 02:23:33.429805
#9 46.94 checking for a sed that does not truncate output... /bin/sed
2025-Oct-06 02:23:33.429805
#9 46.95 checking for pkg-config... /usr/bin/pkg-config
2025-Oct-06 02:23:33.429805
#9 46.95 checking pkg-config is at least version 0.9.0... yes
2025-Oct-06 02:23:33.429805
#9 46.95 checking for cc... cc
2025-Oct-06 02:23:33.429805
#9 46.97 checking whether the C compiler works... yes
2025-Oct-06 02:23:33.429805
#9 47.00 checking for C compiler default output file name... a.out
2025-Oct-06 02:23:33.429805
#9 47.00 checking for suffix of executables...
2025-Oct-06 02:23:33.429805
#9 47.03 checking whether we are cross compiling... no
2025-Oct-06 02:23:33.429805
#9 47.06 checking for suffix of object files... o
2025-Oct-06 02:23:33.429805
#9 47.09 checking whether the compiler supports GNU C... yes
2025-Oct-06 02:23:33.429805
#9 47.11 checking whether cc accepts -g... yes
2025-Oct-06 02:23:33.429805
#9 47.13 checking for cc option to enable C11 features... none needed
2025-Oct-06 02:23:33.429805
#9 47.18 checking how to run the C preprocessor... cc -E
2025-Oct-06 02:23:33.429805
#9 47.23 checking for egrep -e... (cached) /bin/grep -E
2025-Oct-06 02:23:33.429805
#9 47.23 checking for icc... no
2025-Oct-06 02:23:33.429805
#9 47.24 checking for suncc... no
2025-Oct-06 02:23:33.429805
#9 47.25 checking for system library directory... lib
2025-Oct-06 02:23:33.429805
#9 47.25 checking if compiler supports -Wl,-rpath,... yes
2025-Oct-06 02:23:33.429805
#9 47.29 checking build system type... x86_64-pc-linux-musl
2025-Oct-06 02:23:33.429805
#9 47.29 checking host system type... x86_64-pc-linux-musl
2025-Oct-06 02:23:33.429805
#9 47.29 checking target system type... x86_64-pc-linux-musl
2025-Oct-06 02:23:33.429805
#9 47.34 checking for PHP prefix... /usr/local
2025-Oct-06 02:23:33.429805
#9 47.34 checking for PHP includes... -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib
2025-Oct-06 02:23:33.429805
#9 47.34 checking for PHP extension directory... /usr/local/lib/php/extensions/no-debug-non-zts-20220829
2025-Oct-06 02:23:33.429805
#9 47.34 checking for PHP installed headers prefix... /usr/local/include/php
2025-Oct-06 02:23:33.429805
#9 47.34 checking if debug is enabled... no
2025-Oct-06 02:23:33.429805
#9 47.36 checking if zts is enabled... no
2025-Oct-06 02:23:33.429805
#9 47.37 checking for gawk... no
2025-Oct-06 02:23:33.429805
#9 47.37 checking for nawk... no
2025-Oct-06 02:23:33.429805
#9 47.37 checking for awk... awk
2025-Oct-06 02:23:33.429805
#9 47.37 checking if awk is broken... no
2025-Oct-06 02:23:33.429805
#9 47.37 checking for GD support... yes, shared
2025-Oct-06 02:23:33.429805
#9 47.37 checking for external libgd... no
2025-Oct-06 02:23:33.429805
#9 47.37 checking for libavif... no
2025-Oct-06 02:23:33.429805
#9 47.37 checking for libwebp... no
2025-Oct-06 02:23:33.429805
#9 47.37 checking for libjpeg... no
2025-Oct-06 02:23:33.429805
#9 47.37 checking for libXpm... no
2025-Oct-06 02:23:33.429805
#9 47.37 checking for FreeType 2... no
2025-Oct-06 02:23:33.429805
#9 47.37 checking whether to enable JIS-mapped Japanese font support in GD... no
2025-Oct-06 02:23:33.429805
#9 47.37 checking for fabsf... yes
2025-Oct-06 02:23:33.429805
#9 47.41 checking for floorf... yes
2025-Oct-06 02:23:33.429805
#9 47.44 checking for zlib... yes
2025-Oct-06 02:23:33.429805
#9 47.44 checking for libpng... yes
2025-Oct-06 02:23:33.429805
#9 47.51 checking for a sed that does not truncate output... /bin/sed
2025-Oct-06 02:23:33.429805
#9 47.52 checking for ld used by cc... /usr/x86_64-alpine-linux-musl/bin/ld
2025-Oct-06 02:23:33.429805
#9 47.52 checking if the linker (/usr/x86_64-alpine-linux-musl/bin/ld) is GNU ld... yes
2025-Oct-06 02:23:33.429805
#9 47.53 checking for /usr/x86_64-alpine-linux-musl/bin/ld option to reload object files... -r
2025-Oct-06 02:23:33.429805
#9 47.53 checking for BSD-compatible nm... /usr/bin/nm -B
2025-Oct-06 02:23:33.429805
#9 47.53 checking whether ln -s works... yes
2025-Oct-06 02:23:33.429805
#9 47.53 checking how to recognize dependent libraries... pass_all
2025-Oct-06 02:23:33.429805
#9 47.54 checking for stdio.h... yes
2025-Oct-06 02:23:33.429805
#9 47.56 checking for stdlib.h... yes
2025-Oct-06 02:23:33.429805
#9 47.58 checking for string.h... yes
2025-Oct-06 02:23:33.429805
#9 47.59 checking for inttypes.h... yes
2025-Oct-06 02:23:33.429805
#9 47.61 checking for stdint.h... yes
2025-Oct-06 02:23:33.429805
#9 47.63 checking for strings.h... yes
2025-Oct-06 02:23:33.429805
#9 47.65 checking for sys/stat.h... yes
2025-Oct-06 02:23:33.429805
#9 47.67 checking for sys/types.h... yes
2025-Oct-06 02:23:33.429805
#9 47.69 checking for unistd.h... yes
2025-Oct-06 02:23:33.429805
#9 47.71 checking for dlfcn.h... yes
2025-Oct-06 02:23:33.429805
#9 47.73 checking the maximum length of command line arguments... 98304
2025-Oct-06 02:23:33.429805
#9 47.73 checking command to parse /usr/bin/nm -B output from cc object... ok
2025-Oct-06 02:23:33.429805
#9 47.78 checking for objdir... .libs
2025-Oct-06 02:23:33.429805
#9 47.79 checking for ar... ar
2025-Oct-06 02:23:33.429805
#9 47.79 checking for ranlib... ranlib
2025-Oct-06 02:23:33.429805
#9 47.79 checking for strip... strip
2025-Oct-06 02:23:33.429805
#9 47.83 checking if cc supports -fno-rtti -fno-exceptions... no
2025-Oct-06 02:23:33.429805
#9 47.85 checking for cc option to produce PIC... -fPIC
2025-Oct-06 02:23:33.429805
#9 47.85 checking if cc PIC flag -fPIC works... yes
2025-Oct-06 02:23:33.429805
#9 47.87 checking if cc static flag -static works... yes
2025-Oct-06 02:23:33.429805
#9 47.89 checking if cc supports -c -o file.o... yes
2025-Oct-06 02:23:33.429805
#9 47.91 checking whether the cc linker (/usr/x86_64-alpine-linux-musl/bin/ld -m elf_x86_64) supports shared libraries... yes
2025-Oct-06 02:23:33.429805
#9 47.93 checking whether -lc should be explicitly linked in... no
2025-Oct-06 02:23:33.429805
#9 47.95 checking dynamic linker characteristics... GNU/Linux ld.so
2025-Oct-06 02:23:33.429805
#9 47.95 checking how to hardcode library paths into programs... immediate
2025-Oct-06 02:23:33.429805
#9 47.95 checking whether stripping libraries is possible... yes
2025-Oct-06 02:23:33.429805
#9 47.96 checking if libtool supports shared libraries... yes
2025-Oct-06 02:23:33.429805
#9 47.96 checking whether to build shared libraries... yes
2025-Oct-06 02:23:33.429805
#9 47.96 checking whether to build static libraries... no
2025-Oct-06 02:23:33.429805
#9 48.02
2025-Oct-06 02:23:33.429805
#9 48.02 creating libtool
2025-Oct-06 02:23:33.429805
#9 48.06 appending configuration tag "CXX" to libtool
2025-Oct-06 02:23:33.429805
#9 48.12 configure: patching config.h.in
2025-Oct-06 02:23:33.429805
#9 48.12 configure: creating ./config.status
2025-Oct-06 02:23:33.429805
#9 48.15 config.status: creating config.h
2025-Oct-06 02:23:33.429805
#9 48.18 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/gd.c -o gd.lo  -MMD -MF gd.dep -MT gd.lo
2025-Oct-06 02:23:33.429805
#9 48.23 mkdir .libs
2025-Oct-06 02:23:33.429805
#9 48.23  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/gd.c -MMD -MF gd.dep -MT gd.lo  -fPIC -DPIC -o .libs/gd.o
2025-Oct-06 02:23:33.429805
#9 49.40 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd.c -o libgd/gd.lo  -MMD -MF libgd/gd.dep -MT libgd/gd.lo
2025-Oct-06 02:23:33.429805
#9 49.45 mkdir libgd/.libs
2025-Oct-06 02:23:33.429805
#9 49.45  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd.c -MMD -MF libgd/gd.dep -MT libgd/gd.lo  -fPIC -DPIC -o libgd/.libs/gd.o
2025-Oct-06 02:23:33.429805
#9 50.60 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_gd.c -o libgd/gd_gd.lo  -MMD -MF libgd/gd_gd.dep -MT libgd/gd_gd.lo
2025-Oct-06 02:23:33.429805
#9 50.65  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_gd.c -MMD -MF libgd/gd_gd.dep -MT libgd/gd_gd.lo  -fPIC -DPIC -o libgd/.libs/gd_gd.o
2025-Oct-06 02:23:33.429805
#9 50.74 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_gd2.c -o libgd/gd_gd2.lo  -MMD -MF libgd/gd_gd2.dep -MT libgd/gd_gd2.lo
2025-Oct-06 02:23:33.429805
#9 50.79  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_gd2.c -MMD -MF libgd/gd_gd2.dep -MT libgd/gd_gd2.lo  -fPIC -DPIC -o libgd/.libs/gd_gd2.o
2025-Oct-06 02:23:33.429805
#9 51.11 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_io.c -o libgd/gd_io.lo  -MMD -MF libgd/gd_io.dep -MT libgd/gd_io.lo
2025-Oct-06 02:23:33.429805
#9 51.19  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_io.c -MMD -MF libgd/gd_io.dep -MT libgd/gd_io.lo  -fPIC -DPIC -o libgd/.libs/gd_io.o
2025-Oct-06 02:23:33.429805
#9 51.26 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_io_dp.c -o libgd/gd_io_dp.lo  -MMD -MF libgd/gd_io_dp.dep -MT libgd/gd_io_dp.lo
2025-Oct-06 02:23:33.429805
#9 51.33  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_io_dp.c -MMD -MF libgd/gd_io_dp.dep -MT libgd/gd_io_dp.lo  -fPIC -DPIC -o libgd/.libs/gd_io_dp.o
2025-Oct-06 02:23:33.429805
#9 51.52 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_io_file.c -o libgd/gd_io_file.lo  -MMD -MF libgd/gd_io_file.dep -MT libgd/gd_io_file.lo
2025-Oct-06 02:23:33.429805
#9 51.57  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_io_file.c -MMD -MF libgd/gd_io_file.dep -MT libgd/gd_io_file.lo  -fPIC -DPIC -o libgd/.libs/gd_io_file.o
2025-Oct-06 02:23:33.429805
#9 51.72 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_ss.c -o libgd/gd_ss.lo  -MMD -MF libgd/gd_ss.dep -MT libgd/gd_ss.lo
2025-Oct-06 02:23:33.429805
#9 51.77  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_ss.c -MMD -MF libgd/gd_ss.dep -MT libgd/gd_ss.lo  -fPIC -DPIC -o libgd/.libs/gd_ss.o
2025-Oct-06 02:23:33.429805
#9 51.81 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_io_ss.c -o libgd/gd_io_ss.lo  -MMD -MF libgd/gd_io_ss.dep -MT libgd/gd_io_ss.lo
2025-Oct-06 02:23:33.429805
#9 51.86  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_io_ss.c -MMD -MF libgd/gd_io_ss.dep -MT libgd/gd_io_ss.lo  -fPIC -DPIC -o libgd/.libs/gd_io_ss.o
2025-Oct-06 02:23:33.429805
#9 52.02 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_webp.c -o libgd/gd_webp.lo  -MMD -MF libgd/gd_webp.dep -MT libgd/gd_webp.lo
2025-Oct-06 02:23:33.429805
#9 52.08  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_webp.c -MMD -MF libgd/gd_webp.dep -MT libgd/gd_webp.lo  -fPIC -DPIC -o libgd/.libs/gd_webp.o
2025-Oct-06 02:23:33.429805
#9 52.19 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_avif.c -o libgd/gd_avif.lo  -MMD -MF libgd/gd_avif.dep -MT libgd/gd_avif.lo
2025-Oct-06 02:23:33.429805
#9 52.24  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_avif.c -MMD -MF libgd/gd_avif.dep -MT libgd/gd_avif.lo  -fPIC -DPIC -o libgd/.libs/gd_avif.o
2025-Oct-06 02:23:33.429805
#9 52.36 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_png.c -o libgd/gd_png.lo  -MMD -MF libgd/gd_png.dep -MT libgd/gd_png.lo
2025-Oct-06 02:23:33.429805
#9 52.41  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_png.c -MMD -MF libgd/gd_png.dep -MT libgd/gd_png.lo  -fPIC -DPIC -o libgd/.libs/gd_png.o
2025-Oct-06 02:23:33.429805
#9 52.77 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_jpeg.c -o libgd/gd_jpeg.lo  -MMD -MF libgd/gd_jpeg.dep -MT libgd/gd_jpeg.lo
2025-Oct-06 02:23:33.429805
#9 52.82  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_jpeg.c -MMD -MF libgd/gd_jpeg.dep -MT libgd/gd_jpeg.lo  -fPIC -DPIC -o libgd/.libs/gd_jpeg.o
2025-Oct-06 02:23:33.429805
#9 52.84 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdxpm.c -o libgd/gdxpm.lo  -MMD -MF libgd/gdxpm.dep -MT libgd/gdxpm.lo
2025-Oct-06 02:23:33.429805
#9 52.89  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdxpm.c -MMD -MF libgd/gdxpm.dep -MT libgd/gdxpm.lo  -fPIC -DPIC -o libgd/.libs/gdxpm.o
2025-Oct-06 02:23:33.429805
#9 53.02 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdfontt.c -o libgd/gdfontt.lo  -MMD -MF libgd/gdfontt.dep -MT libgd/gdfontt.lo
2025-Oct-06 02:23:33.429805
#9 53.07  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdfontt.c -MMD -MF libgd/gdfontt.dep -MT libgd/gdfontt.lo  -fPIC -DPIC -o libgd/.libs/gdfontt.o
2025-Oct-06 02:23:33.429805
#9 53.11 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdfonts.c -o libgd/gdfonts.lo  -MMD -MF libgd/gdfonts.dep -MT libgd/gdfonts.lo
2025-Oct-06 02:23:33.429805
#9 53.16  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdfonts.c -MMD -MF libgd/gdfonts.dep -MT libgd/gdfonts.lo  -fPIC -DPIC -o libgd/.libs/gdfonts.o
2025-Oct-06 02:23:33.429805
#9 53.21 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdfontmb.c -o libgd/gdfontmb.lo  -MMD -MF libgd/gdfontmb.dep -MT libgd/gdfontmb.lo
2025-Oct-06 02:23:33.429805
#9 53.27  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdfontmb.c -MMD -MF libgd/gdfontmb.dep -MT libgd/gdfontmb.lo  -fPIC -DPIC -o libgd/.libs/gdfontmb.o
2025-Oct-06 02:23:33.429805
#9 53.32 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdfontl.c -o libgd/gdfontl.lo  -MMD -MF libgd/gdfontl.dep -MT libgd/gdfontl.lo
2025-Oct-06 02:23:33.429805
#9 53.37  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdfontl.c -MMD -MF libgd/gdfontl.dep -MT libgd/gdfontl.lo  -fPIC -DPIC -o libgd/.libs/gdfontl.o
2025-Oct-06 02:23:33.429805
#9 53.43 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdfontg.c -o libgd/gdfontg.lo  -MMD -MF libgd/gdfontg.dep -MT libgd/gdfontg.lo
2025-Oct-06 02:23:33.429805
#9 53.49  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdfontg.c -MMD -MF libgd/gdfontg.dep -MT libgd/gdfontg.lo  -fPIC -DPIC -o libgd/.libs/gdfontg.o
2025-Oct-06 02:23:33.429805
#9 53.56 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdtables.c -o libgd/gdtables.lo  -MMD -MF libgd/gdtables.dep -MT libgd/gdtables.lo
2025-Oct-06 02:23:33.429805
#9 53.61  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdtables.c -MMD -MF libgd/gdtables.dep -MT libgd/gdtables.lo  -fPIC -DPIC -o libgd/.libs/gdtables.o
2025-Oct-06 02:23:33.429805
#9 53.63 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdft.c -o libgd/gdft.lo  -MMD -MF libgd/gdft.dep -MT libgd/gdft.lo
2025-Oct-06 02:23:33.429805
#9 53.69  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdft.c -MMD -MF libgd/gdft.dep -MT libgd/gdft.lo  -fPIC -DPIC -o libgd/.libs/gdft.o
2025-Oct-06 02:23:33.429805
#9 53.83 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdcache.c -o libgd/gdcache.lo  -MMD -MF libgd/gdcache.dep -MT libgd/gdcache.lo
2025-Oct-06 02:23:33.429805
#9 53.88  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdcache.c -MMD -MF libgd/gdcache.dep -MT libgd/gdcache.lo  -fPIC -DPIC -o libgd/.libs/gdcache.o
2025-Oct-06 02:23:33.429805
#9 54.00 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdkanji.c -o libgd/gdkanji.lo  -MMD -MF libgd/gdkanji.dep -MT libgd/gdkanji.lo
2025-Oct-06 02:23:33.429805
#9 54.05  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdkanji.c -MMD -MF libgd/gdkanji.dep -MT libgd/gdkanji.lo  -fPIC -DPIC -o libgd/.libs/gdkanji.o
2025-Oct-06 02:23:33.429805
#9 54.33 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/wbmp.c -o libgd/wbmp.lo  -MMD -MF libgd/wbmp.dep -MT libgd/wbmp.lo
2025-Oct-06 02:23:33.429805
#9 54.38  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/wbmp.c -MMD -MF libgd/wbmp.dep -MT libgd/wbmp.lo  -fPIC -DPIC -o libgd/.libs/wbmp.o
2025-Oct-06 02:23:33.429805
#9 54.57 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_wbmp.c -o libgd/gd_wbmp.lo  -MMD -MF libgd/gd_wbmp.dep -MT libgd/gd_wbmp.lo
2025-Oct-06 02:23:33.429805
#9 54.62  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_wbmp.c -MMD -MF libgd/gd_wbmp.dep -MT libgd/gd_wbmp.lo  -fPIC -DPIC -o libgd/.libs/gd_wbmp.o
2025-Oct-06 02:23:33.429805
#9 54.69 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdhelpers.c -o libgd/gdhelpers.lo  -MMD -MF libgd/gdhelpers.dep -MT libgd/gdhelpers.lo
2025-Oct-06 02:23:33.429805
#9 54.75  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gdhelpers.c -MMD -MF libgd/gdhelpers.dep -MT libgd/gdhelpers.lo  -fPIC -DPIC -o libgd/.libs/gdhelpers.o
2025-Oct-06 02:23:33.429805
#9 54.88 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_topal.c -o libgd/gd_topal.lo  -MMD -MF libgd/gd_topal.dep -MT libgd/gd_topal.lo
2025-Oct-06 02:23:33.429805
#9 54.93  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_topal.c -MMD -MF libgd/gd_topal.dep -MT libgd/gd_topal.lo  -fPIC -DPIC -o libgd/.libs/gd_topal.o
2025-Oct-06 02:23:33.429805
#9 55.32 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_gif_in.c -o libgd/gd_gif_in.lo  -MMD -MF libgd/gd_gif_in.dep -MT libgd/gd_gif_in.lo
2025-Oct-06 02:23:33.429805
#9 55.37  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_gif_in.c -MMD -MF libgd/gd_gif_in.dep -MT libgd/gd_gif_in.lo  -fPIC -DPIC -o libgd/.libs/gd_gif_in.o
2025-Oct-06 02:23:33.429805
#9 55.60 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_xbm.c -o libgd/gd_xbm.lo  -MMD -MF libgd/gd_xbm.dep -MT libgd/gd_xbm.lo
2025-Oct-06 02:23:33.429805
#9 55.65  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_xbm.c -MMD -MF libgd/gd_xbm.dep -MT libgd/gd_xbm.lo  -fPIC -DPIC -o libgd/.libs/gd_xbm.o
2025-Oct-06 02:23:33.429805
#9 55.84 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_gif_out.c -o libgd/gd_gif_out.lo  -MMD -MF libgd/gd_gif_out.dep -MT libgd/gd_gif_out.lo
2025-Oct-06 02:23:33.429805
#9 55.89  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_gif_out.c -MMD -MF libgd/gd_gif_out.dep -MT libgd/gd_gif_out.lo  -fPIC -DPIC -o libgd/.libs/gd_gif_out.o
2025-Oct-06 02:23:33.429805
#9 56.01 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_security.c -o libgd/gd_security.lo  -MMD -MF libgd/gd_security.dep -MT libgd/gd_security.lo
2025-Oct-06 02:23:33.429805
#9 56.06  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_security.c -MMD -MF libgd/gd_security.dep -MT libgd/gd_security.lo  -fPIC -DPIC -o libgd/.libs/gd_security.o
2025-Oct-06 02:23:33.429805
#9 56.10 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_filter.c -o libgd/gd_filter.lo  -MMD -MF libgd/gd_filter.dep -MT libgd/gd_filter.lo
2025-Oct-06 02:23:33.429805
#9 56.15  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_filter.c -MMD -MF libgd/gd_filter.dep -MT libgd/gd_filter.lo  -fPIC -DPIC -o libgd/.libs/gd_filter.o
2025-Oct-06 02:23:33.429805
#9 56.39 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_pixelate.c -o libgd/gd_pixelate.lo  -MMD -MF libgd/gd_pixelate.dep -MT libgd/gd_pixelate.lo
2025-Oct-06 02:23:33.429805
#9 56.44  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_pixelate.c -MMD -MF libgd/gd_pixelate.dep -MT libgd/gd_pixelate.lo  -fPIC -DPIC -o libgd/.libs/gd_pixelate.o
2025-Oct-06 02:23:33.429805
#9 56.49 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_rotate.c -o libgd/gd_rotate.lo  -MMD -MF libgd/gd_rotate.dep -MT libgd/gd_rotate.lo
2025-Oct-06 02:23:33.429805
#9 56.55  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_rotate.c -MMD -MF libgd/gd_rotate.dep -MT libgd/gd_rotate.lo  -fPIC -DPIC -o libgd/.libs/gd_rotate.o
2025-Oct-06 02:23:33.429805
#9 56.67 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_color_match.c -o libgd/gd_color_match.lo  -MMD -MF libgd/gd_color_match.dep -MT libgd/gd_color_match.lo
2025-Oct-06 02:23:33.429805
#9 56.74  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_color_match.c -MMD -MF libgd/gd_color_match.dep -MT libgd/gd_color_match.lo  -fPIC -DPIC -o libgd/.libs/gd_color_match.o
2025-Oct-06 02:23:33.429805
#9 56.88 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_transform.c -o libgd/gd_transform.lo  -MMD -MF libgd/gd_transform.dep -MT libgd/gd_transform.lo
2025-Oct-06 02:23:33.429805
#9 56.94  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_transform.c -MMD -MF libgd/gd_transform.dep -MT libgd/gd_transform.lo  -fPIC -DPIC -o libgd/.libs/gd_transform.o
2025-Oct-06 02:23:33.429805
#9 56.99 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_crop.c -o libgd/gd_crop.lo  -MMD -MF libgd/gd_crop.dep -MT libgd/gd_crop.lo
2025-Oct-06 02:23:33.429805
#9 57.04  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_crop.c -MMD -MF libgd/gd_crop.dep -MT libgd/gd_crop.lo  -fPIC -DPIC -o libgd/.libs/gd_crop.o
2025-Oct-06 02:23:33.429805
#9 57.15 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_interpolation.c -o libgd/gd_interpolation.lo  -MMD -MF libgd/gd_interpolation.dep -MT libgd/gd_interpolation.lo
2025-Oct-06 02:23:33.429805
#9 57.20  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_interpolation.c -MMD -MF libgd/gd_interpolation.dep -MT libgd/gd_interpolation.lo  -fPIC -DPIC -o libgd/.libs/gd_interpolation.o
2025-Oct-06 02:23:33.429805
#9 58.40 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_matrix.c -o libgd/gd_matrix.lo  -MMD -MF libgd/gd_matrix.dep -MT libgd/gd_matrix.lo
2025-Oct-06 02:23:33.429805
#9 58.45  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_matrix.c -MMD -MF libgd/gd_matrix.dep -MT libgd/gd_matrix.lo  -fPIC -DPIC -o libgd/.libs/gd_matrix.o
2025-Oct-06 02:23:33.429805
#9 58.53 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_bmp.c -o libgd/gd_bmp.lo  -MMD -MF libgd/gd_bmp.dep -MT libgd/gd_bmp.lo
2025-Oct-06 02:23:33.429805
#9 58.58  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_bmp.c -MMD -MF libgd/gd_bmp.dep -MT libgd/gd_bmp.lo  -fPIC -DPIC -o libgd/.libs/gd_bmp.o
2025-Oct-06 02:23:33.429805
#9 59.01 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=compile cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE   -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_tga.c -o libgd/gd_tga.lo  -MMD -MF libgd/gd_tga.dep -MT libgd/gd_tga.lo
2025-Oct-06 02:23:33.429805
#9 59.07  cc -I. -I/usr/src/php/ext/gd -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16 -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE -I/usr/src/php/ext/gd/libgd -DZEND_COMPILE_DL_EXT=1 -c /usr/src/php/ext/gd/libgd/gd_tga.c -MMD -MF libgd/gd_tga.dep -MT libgd/gd_tga.lo  -fPIC -DPIC -o libgd/.libs/gd_tga.o
2025-Oct-06 02:23:33.429805
#9 59.33 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=link cc -shared -I/usr/src/php/ext/gd/include -I/usr/src/php/ext/gd/main -I/usr/src/php/ext/gd -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -I/usr/include/libpng16  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -D_GNU_SOURCE  -Wl,-O1 -pie  -o gd.la -export-dynamic -avoid-version -prefer-pic -module -rpath /usr/src/php/ext/gd/modules  gd.lo libgd/gd.lo libgd/gd_gd.lo libgd/gd_gd2.lo libgd/gd_io.lo libgd/gd_io_dp.lo libgd/gd_io_file.lo libgd/gd_ss.lo libgd/gd_io_ss.lo libgd/gd_webp.lo libgd/gd_avif.lo libgd/gd_png.lo libgd/gd_jpeg.lo libgd/gdxpm.lo libgd/gdfontt.lo libgd/gdfonts.lo libgd/gdfontmb.lo libgd/gdfontl.lo libgd/gdfontg.lo libgd/gdtables.lo libgd/gdft.lo libgd/gdcache.lo libgd/gdkanji.lo libgd/wbmp.lo libgd/gd_wbmp.lo libgd/gdhelpers.lo libgd/gd_topal.lo libgd/gd_gif_in.lo libgd/gd_xbm.lo libgd/gd_gif_out.lo libgd/gd_security.lo libgd/gd_filter.lo libgd/gd_pixelate.lo libgd/gd_rotate.lo libgd/gd_color_match.lo libgd/gd_transform.lo libgd/gd_crop.lo libgd/gd_interpolation.lo libgd/gd_matrix.lo libgd/gd_bmp.lo libgd/gd_tga.lo -lz -lpng16
2025-Oct-06 02:23:33.429805
#9 59.45 cc -shared  .libs/gd.o libgd/.libs/gd.o libgd/.libs/gd_gd.o libgd/.libs/gd_gd2.o libgd/.libs/gd_io.o libgd/.libs/gd_io_dp.o libgd/.libs/gd_io_file.o libgd/.libs/gd_ss.o libgd/.libs/gd_io_ss.o libgd/.libs/gd_webp.o libgd/.libs/gd_avif.o libgd/.libs/gd_png.o libgd/.libs/gd_jpeg.o libgd/.libs/gdxpm.o libgd/.libs/gdfontt.o libgd/.libs/gdfonts.o libgd/.libs/gdfontmb.o libgd/.libs/gdfontl.o libgd/.libs/gdfontg.o libgd/.libs/gdtables.o libgd/.libs/gdft.o libgd/.libs/gdcache.o libgd/.libs/gdkanji.o libgd/.libs/wbmp.o libgd/.libs/gd_wbmp.o libgd/.libs/gdhelpers.o libgd/.libs/gd_topal.o libgd/.libs/gd_gif_in.o libgd/.libs/gd_xbm.o libgd/.libs/gd_gif_out.o libgd/.libs/gd_security.o libgd/.libs/gd_filter.o libgd/.libs/gd_pixelate.o libgd/.libs/gd_rotate.o libgd/.libs/gd_color_match.o libgd/.libs/gd_transform.o libgd/.libs/gd_crop.o libgd/.libs/gd_interpolation.o libgd/.libs/gd_matrix.o libgd/.libs/gd_bmp.o libgd/.libs/gd_tga.o  -lz -lpng16  -Wl,-O1 -Wl,-soname -Wl,gd.so -o .libs/gd.so
2025-Oct-06 02:23:33.429805
#9 59.48 creating gd.la
2025-Oct-06 02:23:33.429805
#9 59.48 (cd .libs && rm -f gd.la && ln -s ../gd.la gd.la)
2025-Oct-06 02:23:33.429805
#9 59.48 /bin/sh /usr/src/php/ext/gd/libtool --tag=CC --mode=install cp ./gd.la /usr/src/php/ext/gd/modules
2025-Oct-06 02:23:33.429805
#9 59.50 cp ./.libs/gd.so /usr/src/php/ext/gd/modules/gd.so
2025-Oct-06 02:23:33.429805
#9 59.50 cp ./.libs/gd.lai /usr/src/php/ext/gd/modules/gd.la
2025-Oct-06 02:23:33.429805
#9 59.51 PATH="$PATH:/sbin" ldconfig -n /usr/src/php/ext/gd/modules
2025-Oct-06 02:23:33.429805
#9 59.51 ----------------------------------------------------------------------
2025-Oct-06 02:23:33.429805
#9 59.51 Libraries have been installed in:
2025-Oct-06 02:23:33.429805
#9 59.51    /usr/src/php/ext/gd/modules
2025-Oct-06 02:23:33.429805
#9 59.51
2025-Oct-06 02:23:33.429805
#9 59.51 If you ever happen to want to link against installed libraries
2025-Oct-06 02:23:33.429805
#9 59.51 in a given directory, LIBDIR, you must either use libtool, and
2025-Oct-06 02:23:33.429805
#9 59.51 specify the full pathname of the library, or use the `-LLIBDIR'
2025-Oct-06 02:23:33.429805
#9 59.51 flag during linking and do at least one of the following:
2025-Oct-06 02:23:33.429805
#9 59.51    - add LIBDIR to the `LD_LIBRARY_PATH' environment variable
2025-Oct-06 02:23:33.429805
#9 59.51      during execution
2025-Oct-06 02:23:33.429805
#9 59.51    - add LIBDIR to the `LD_RUN_PATH' environment variable
2025-Oct-06 02:23:33.429805
#9 59.51      during linking
2025-Oct-06 02:23:33.429805
#9 59.51    - use the `-Wl,--rpath -Wl,LIBDIR' linker flag
2025-Oct-06 02:23:33.429805
#9 59.51
2025-Oct-06 02:23:33.429805
#9 59.51 See any operating system documentation about shared libraries for
2025-Oct-06 02:23:33.429805
#9 59.51 more information, such as the ld(1) and ld.so(8) manual pages.
2025-Oct-06 02:23:33.429805
#9 59.51 ----------------------------------------------------------------------
2025-Oct-06 02:23:33.429805
#9 59.51
2025-Oct-06 02:23:33.429805
#9 59.51 Build complete.
2025-Oct-06 02:23:33.429805
#9 59.51 Don't forget to run 'make test'.
2025-Oct-06 02:23:33.429805
#9 59.51
2025-Oct-06 02:23:33.429805
#9 59.53 + strip --strip-all modules/gd.so
2025-Oct-06 02:23:33.429805
#9 59.56 Installing shared extensions:     /usr/local/lib/php/extensions/no-debug-non-zts-20220829/
2025-Oct-06 02:23:33.429805
#9 59.64 Installing header files:          /usr/local/include/php/
2025-Oct-06 02:23:33.429805
#9 59.91 find . -name \*.gcno -o -name \*.gcda | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 59.92 find . -name \*.lo -o -name \*.o -o -name \*.dep | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 59.93 find . -name \*.la -o -name \*.a | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 59.93 find . -name \*.so | xargs rm -f
2025-Oct-06 02:23:33.429805
#9 59.93 find . -name .libs -a -type d|xargs rm -rf
2025-Oct-06 02:23:33.429805
#9 59.94 rm -f libphp.la      modules/* libs/*
2025-Oct-06 02:23:33.429805
#9 59.94 rm -f ext/opcache/jit/zend_jit_x86.c
2025-Oct-06 02:23:33.429805
#9 59.94 rm -f ext/opcache/jit/zend_jit_arm64.c
2025-Oct-06 02:23:33.429805
#9 59.94 rm -f ext/opcache/minilua
2025-Oct-06 02:23:33.429805
#9 59.95 WARNING: opening from cache https://dl-cdn.alpinelinux.org/alpine/v3.22/main: No such file or directory
2025-Oct-06 02:23:33.429805
#9 59.95 WARNING: opening from cache https://dl-cdn.alpinelinux.org/alpine/v3.22/community: No such file or directory
2025-Oct-06 02:23:33.429805
#9 59.95 (1/27) Purging .phpize-deps (20251006.022213)
2025-Oct-06 02:23:33.429805
#9 59.95 (2/27) Purging autoconf (2.72-r1)
2025-Oct-06 02:23:33.429805
#9 59.95 (3/27) Purging m4 (1.4.19-r4)
2025-Oct-06 02:23:33.429805
#9 59.95 (4/27) Purging dpkg-dev (1.22.15-r0)
2025-Oct-06 02:23:33.429805
#9 59.95 (5/27) Purging dpkg (1.22.15-r0)
2025-Oct-06 02:23:33.429805
#9 59.95 (6/27) Purging file (5.46-r2)
2025-Oct-06 02:23:33.429805
#9 59.95 (7/27) Purging g++ (14.2.0-r6)
2025-Oct-06 02:23:33.429805
#9 59.96 (8/27) Purging libstdc++-dev (14.2.0-r6)
2025-Oct-06 02:23:33.429805
#9 59.99 (9/27) Purging gcc (14.2.0-r6)
2025-Oct-06 02:23:33.429805
#9 60.03 (10/27) Purging binutils (2.44-r3)
2025-Oct-06 02:23:33.429805
#9 60.03 (11/27) Purging libatomic (14.2.0-r6)
2025-Oct-06 02:23:33.429805
#9 60.03 (12/27) Purging libgomp (14.2.0-r6)
2025-Oct-06 02:23:33.429805
#9 60.03 (13/27) Purging make (4.4.1-r3)
2025-Oct-06 02:23:33.429805
#9 60.03 (14/27) Purging re2c (4.2-r0)
2025-Oct-06 02:23:33.429805
#9 60.04 (15/27) Purging git-perl (2.49.1-r0)
2025-Oct-06 02:23:33.429805
#9 60.04 (16/27) Purging perl-git (2.49.1-r0)
2025-Oct-06 02:23:33.429805
#9 60.04 (17/27) Purging perl-error (0.17030-r0)
2025-Oct-06 02:23:33.429805
#9 60.04 (18/27) Purging isl26 (0.26-r1)
2025-Oct-06 02:23:33.429805
#9 60.04 (19/27) Purging jansson (2.14.1-r0)
2025-Oct-06 02:23:33.429805
#9 60.04 (20/27) Purging libmagic (5.46-r2)
2025-Oct-06 02:23:33.429805
#9 60.04 (21/27) Purging libmd (1.1.0-r0)
2025-Oct-06 02:23:33.429805
#9 60.04 (22/27) Purging mariadb-client-perl (11.4.8-r0)
2025-Oct-06 02:23:33.429805
#9 60.04 (23/27) Purging perl (5.40.3-r0)
2025-Oct-06 02:23:33.429805
#9 60.09 (24/27) Purging mpc1 (1.3.1-r1)
2025-Oct-06 02:23:33.429805
#9 60.09 (25/27) Purging mpfr4 (4.2.1_p1-r0)
2025-Oct-06 02:23:33.429805
#9 60.09 (26/27) Purging musl-dev (1.2.5-r10)
2025-Oct-06 02:23:33.429805
#9 60.10 (27/27) Purging gmp (6.3.0-r3)
2025-Oct-06 02:23:33.429805
#9 60.10 Executing busybox-1.37.0-r18.trigger
2025-Oct-06 02:23:33.429805
#9 60.11 OK: 189 MiB in 84 packages
2025-Oct-06 02:23:33.429805
#9 DONE 60.9s
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#10 [stage-0  4/17] COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
2025-Oct-06 02:23:33.429805
#10 DONE 0.0s
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#11 [stage-0  5/17] RUN addgroup -g 1000 www && adduser -u 1000 -G www -s /bin/sh -D www
2025-Oct-06 02:23:33.429805
#11 DONE 0.1s
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#12 [stage-0  6/17] WORKDIR /var/www
2025-Oct-06 02:23:33.429805
#12 DONE 0.0s
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#13 [stage-0  7/17] COPY --chown=www:www ./backend /var/www/backend
2025-Oct-06 02:23:33.429805
#13 DONE 0.1s
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#14 [stage-0  8/17] WORKDIR /var/www/backend
2025-Oct-06 02:23:33.429805
#14 DONE 0.0s
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#15 [stage-0  9/17] RUN composer install --optimize-autoloader --no-dev --no-interaction
2025-Oct-06 02:23:33.429805
#15 0.138 Installing dependencies from lock file
2025-Oct-06 02:23:33.429805
#15 0.142 Verifying lock file contents can be installed on current platform.
2025-Oct-06 02:23:33.429805
#15 0.157 Package operations: 76 installs, 0 updates, 0 removals
2025-Oct-06 02:23:33.429805
#15 0.161   - Downloading doctrine/inflector (2.0.10)
2025-Oct-06 02:23:33.429805
#15 0.162   - Downloading doctrine/lexer (3.0.1)
2025-Oct-06 02:23:33.429805
#15 0.162   - Downloading symfony/polyfill-ctype (v1.32.0)
2025-Oct-06 02:23:33.429805
#15 0.162   - Downloading webmozart/assert (1.11.0)
2025-Oct-06 02:23:33.429805
#15 0.163   - Downloading dragonmantank/cron-expression (v3.4.0)
2025-Oct-06 02:23:33.429805
#15 0.163   - Downloading symfony/polyfill-php83 (v1.32.0)
2025-Oct-06 02:23:33.429805
#15 0.163   - Downloading symfony/polyfill-mbstring (v1.32.0)
2025-Oct-06 02:23:33.429805
#15 0.163   - Downloading symfony/deprecation-contracts (v3.6.0)
2025-Oct-06 02:23:33.429805
#15 0.164   - Downloading symfony/http-foundation (v7.3.1)
2025-Oct-06 02:23:33.429805
#15 0.164   - Downloading fruitcake/php-cors (v1.3.0)
2025-Oct-06 02:23:33.429805
#15 0.164   - Downloading psr/http-message (2.0)
2025-Oct-06 02:23:33.429805
#15 0.164   - Downloading psr/http-client (1.0.3)
2025-Oct-06 02:23:33.429805
#15 0.165   - Downloading ralouphie/getallheaders (3.0.3)
2025-Oct-06 02:23:33.429805
#15 0.165   - Downloading psr/http-factory (1.1.0)
2025-Oct-06 02:23:33.429805
#15 0.165   - Downloading guzzlehttp/psr7 (2.7.1)
2025-Oct-06 02:23:33.429805
#15 0.165   - Downloading guzzlehttp/promises (2.2.0)
2025-Oct-06 02:23:33.429805
#15 0.165   - Downloading guzzlehttp/guzzle (7.9.3)
2025-Oct-06 02:23:33.429805
#15 0.165   - Downloading symfony/polyfill-php80 (v1.32.0)
2025-Oct-06 02:23:33.429805
#15 0.166   - Downloading guzzlehttp/uri-template (v1.0.4)
2025-Oct-06 02:23:33.429805
#15 0.166   - Downloading symfony/polyfill-intl-normalizer (v1.32.0)
2025-Oct-06 02:23:33.429805
#15 0.166   - Downloading symfony/polyfill-intl-grapheme (v1.32.0)
2025-Oct-06 02:23:33.429805
#15 0.166   - Downloading symfony/string (v7.3.0)
2025-Oct-06 02:23:33.429805
#15 0.166   - Downloading psr/container (2.0.2)
2025-Oct-06 02:23:33.429805
#15 0.166   - Downloading symfony/service-contracts (v3.6.0)
2025-Oct-06 02:23:33.429805
#15 0.166   - Downloading symfony/console (v7.3.1)
2025-Oct-06 02:23:33.429805
#15 0.166   - Downloading laravel/prompts (v0.3.6)
2025-Oct-06 02:23:33.429805
#15 0.166   - Downloading voku/portable-ascii (2.0.3)
2025-Oct-06 02:23:33.429805
#15 0.166   - Downloading phpoption/phpoption (1.9.3)
2025-Oct-06 02:23:33.429805
#15 0.167   - Downloading graham-campbell/result-type (v1.1.3)
2025-Oct-06 02:23:33.429805
#15 0.167   - Downloading vlucas/phpdotenv (v5.6.2)
2025-Oct-06 02:23:33.429805
#15 0.167   - Downloading symfony/css-selector (v7.3.0)
2025-Oct-06 02:23:33.429805
#15 0.167   - Downloading tijsverkoyen/css-to-inline-styles (v2.3.0)
2025-Oct-06 02:23:33.429805
#15 0.167   - Downloading symfony/var-dumper (v7.3.1)
2025-Oct-06 02:23:33.429805
#15 0.167   - Downloading symfony/polyfill-uuid (v1.32.0)
2025-Oct-06 02:23:33.429805
#15 0.167   - Downloading symfony/uid (v7.3.1)
2025-Oct-06 02:23:33.429805
#15 0.168   - Downloading symfony/routing (v7.3.0)
2025-Oct-06 02:23:33.429805
#15 0.168   - Downloading symfony/process (v7.3.0)
2025-Oct-06 02:23:33.429805
#15 0.168   - Downloading symfony/polyfill-intl-idn (v1.32.0)
2025-Oct-06 02:23:33.429805
#15 0.168   - Downloading symfony/mime (v7.3.0)
2025-Oct-06 02:23:33.429805
#15 0.168   - Downloading psr/event-dispatcher (1.0.0)
2025-Oct-06 02:23:33.429805
#15 0.168   - Downloading symfony/event-dispatcher-contracts (v3.6.0)
2025-Oct-06 02:23:33.429805
#15 0.168   - Downloading symfony/event-dispatcher (v7.3.0)
2025-Oct-06 02:23:33.429805
#15 0.169   - Downloading psr/log (3.0.2)
2025-Oct-06 02:23:33.429805
#15 0.169   - Downloading egulias/email-validator (4.0.4)
2025-Oct-06 02:23:33.429805
#15 0.169   - Downloading symfony/mailer (v7.3.1)
2025-Oct-06 02:23:33.429805
#15 0.169   - Downloading symfony/error-handler (v7.3.1)
2025-Oct-06 02:23:33.429805
#15 0.169   - Downloading symfony/http-kernel (v7.3.1)
2025-Oct-06 02:23:33.429805
#15 0.169   - Downloading symfony/finder (v7.3.0)
2025-Oct-06 02:23:33.429805
#15 0.169   - Downloading ramsey/collection (2.1.1)
2025-Oct-06 02:23:33.429805
#15 0.170   - Downloading brick/math (0.13.1)
2025-Oct-06 02:23:33.429805
#15 0.170   - Downloading ramsey/uuid (4.9.0)
2025-Oct-06 02:23:33.429805
#15 0.170   - Downloading psr/simple-cache (3.0.0)
2025-Oct-06 02:23:33.429805
#15 0.170   - Downloading nunomaduro/termwind (v2.3.1)
2025-Oct-06 02:23:33.429805
#15 0.170   - Downloading symfony/translation-contracts (v3.6.0)
2025-Oct-06 02:23:33.429805
#15 0.170   - Downloading symfony/translation (v7.3.1)
2025-Oct-06 02:23:33.429805
#15 0.170   - Downloading psr/clock (1.0.0)
2025-Oct-06 02:23:33.429805
#15 0.171   - Downloading symfony/clock (v7.3.0)
2025-Oct-06 02:23:33.429805
#15 0.171   - Downloading carbonphp/carbon-doctrine-types (3.2.0)
2025-Oct-06 02:23:33.429805
#15 0.171   - Downloading nesbot/carbon (3.10.1)
2025-Oct-06 02:23:33.429805
#15 0.171   - Downloading monolog/monolog (3.9.0)
2025-Oct-06 02:23:33.429805
#15 0.171   - Downloading league/uri-interfaces (7.5.0)
2025-Oct-06 02:23:33.429805
#15 0.172   - Downloading league/uri (7.5.1)
2025-Oct-06 02:23:33.429805
#15 0.172   - Downloading league/mime-type-detection (1.16.0)
2025-Oct-06 02:23:33.429805
#15 0.172   - Downloading league/flysystem-local (3.30.0)
2025-Oct-06 02:23:33.429805
#15 0.172   - Downloading league/flysystem (3.30.0)
2025-Oct-06 02:23:33.429805
#15 0.172   - Downloading nette/utils (v4.0.7)
2025-Oct-06 02:23:33.429805
#15 0.172   - Downloading nette/schema (v1.3.2)
2025-Oct-06 02:23:33.429805
#15 0.172   - Downloading dflydev/dot-access-data (v3.0.3)
2025-Oct-06 02:23:33.429805
#15 0.172   - Downloading league/config (v1.2.0)
2025-Oct-06 02:23:33.429805
#15 0.173   - Downloading league/commonmark (2.7.1)
2025-Oct-06 02:23:33.429805
#15 0.173   - Downloading laravel/serializable-closure (v2.0.4)
2025-Oct-06 02:23:33.429805
#15 0.173   - Downloading laravel/framework (v12.20.0)
2025-Oct-06 02:23:33.429805
#15 0.173   - Downloading laravel/sanctum (v4.1.2)
2025-Oct-06 02:23:33.429805
#15 0.173   - Downloading nikic/php-parser (v5.5.0)
2025-Oct-06 02:23:33.429805
#15 0.173   - Downloading psy/psysh (v0.12.9)
2025-Oct-06 02:23:33.429805
#15 0.173   - Downloading laravel/tinker (v2.10.1)
2025-Oct-06 02:23:33.429805
#15 0.178   0/76 [>---------------------------]   0%
2025-Oct-06 02:23:33.429805
#15 0.495  18/76 [======>---------------------]  23%
2025-Oct-06 02:23:33.429805
#15 0.597  39/76 [==============>-------------]  51%
2025-Oct-06 02:23:33.429805
#15 0.701  57/76 [=====================>------]  75%
2025-Oct-06 02:23:33.429805
#15 0.801  72/76 [==========================>-]  94%
2025-Oct-06 02:23:33.429805
#15 0.900  76/76 [============================] 100%
2025-Oct-06 02:23:33.429805
#15 0.900   - Installing doctrine/inflector (2.0.10): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.903   - Installing doctrine/lexer (3.0.1): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.905   - Installing symfony/polyfill-ctype (v1.32.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.910   - Installing webmozart/assert (1.11.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.912   - Installing dragonmantank/cron-expression (v3.4.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.915   - Installing symfony/polyfill-php83 (v1.32.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.917   - Installing symfony/polyfill-mbstring (v1.32.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.918   - Installing symfony/deprecation-contracts (v3.6.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.921   - Installing symfony/http-foundation (v7.3.1): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.923   - Installing fruitcake/php-cors (v1.3.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.925   - Installing psr/http-message (2.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.926   - Installing psr/http-client (1.0.3): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.926   - Installing ralouphie/getallheaders (3.0.3): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.927   - Installing psr/http-factory (1.1.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.927   - Installing guzzlehttp/psr7 (2.7.1): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.928   - Installing guzzlehttp/promises (2.2.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.928   - Installing guzzlehttp/guzzle (7.9.3): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.928   - Installing symfony/polyfill-php80 (v1.32.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.929   - Installing guzzlehttp/uri-template (v1.0.4): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.929   - Installing symfony/polyfill-intl-normalizer (v1.32.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.930   - Installing symfony/polyfill-intl-grapheme (v1.32.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.930   - Installing symfony/string (v7.3.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.931   - Installing psr/container (2.0.2): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.932   - Installing symfony/service-contracts (v3.6.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.932   - Installing symfony/console (v7.3.1): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.932   - Installing laravel/prompts (v0.3.6): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.932   - Installing voku/portable-ascii (2.0.3): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.932   - Installing phpoption/phpoption (1.9.3): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.933   - Installing graham-campbell/result-type (v1.1.3): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.933   - Installing vlucas/phpdotenv (v5.6.2): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.933   - Installing symfony/css-selector (v7.3.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.933   - Installing tijsverkoyen/css-to-inline-styles (v2.3.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.934   - Installing symfony/var-dumper (v7.3.1): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.934   - Installing symfony/polyfill-uuid (v1.32.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.934   - Installing symfony/uid (v7.3.1): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.934   - Installing symfony/routing (v7.3.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.934   - Installing symfony/process (v7.3.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.934   - Installing symfony/polyfill-intl-idn (v1.32.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.935   - Installing symfony/mime (v7.3.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.935   - Installing psr/event-dispatcher (1.0.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.935   - Installing symfony/event-dispatcher-contracts (v3.6.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.935   - Installing symfony/event-dispatcher (v7.3.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.935   - Installing psr/log (3.0.2): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.936   - Installing egulias/email-validator (4.0.4): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.936   - Installing symfony/mailer (v7.3.1): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.936   - Installing symfony/error-handler (v7.3.1): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.936   - Installing symfony/http-kernel (v7.3.1): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.936   - Installing symfony/finder (v7.3.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.937   - Installing ramsey/collection (2.1.1): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.937   - Installing brick/math (0.13.1): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.937   - Installing ramsey/uuid (4.9.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.937   - Installing psr/simple-cache (3.0.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.937   - Installing nunomaduro/termwind (v2.3.1): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.937   - Installing symfony/translation-contracts (v3.6.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.938   - Installing symfony/translation (v7.3.1): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.938   - Installing psr/clock (1.0.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.938   - Installing symfony/clock (v7.3.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.938   - Installing carbonphp/carbon-doctrine-types (3.2.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.938   - Installing nesbot/carbon (3.10.1): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.939   - Installing monolog/monolog (3.9.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.939   - Installing league/uri-interfaces (7.5.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.939   - Installing league/uri (7.5.1): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.939   - Installing league/mime-type-detection (1.16.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.939   - Installing league/flysystem-local (3.30.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.940   - Installing league/flysystem (3.30.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.940   - Installing nette/utils (v4.0.7): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.940   - Installing nette/schema (v1.3.2): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.940   - Installing dflydev/dot-access-data (v3.0.3): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.940   - Installing league/config (v1.2.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.941   - Installing league/commonmark (2.7.1): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.941   - Installing laravel/serializable-closure (v2.0.4): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.941   - Installing laravel/framework (v12.20.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.941   - Installing laravel/sanctum (v4.1.2): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.942   - Installing nikic/php-parser (v5.5.0): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.942   - Installing psy/psysh (v0.12.9): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.942   - Installing laravel/tinker (v2.10.1): Extracting archive
2025-Oct-06 02:23:33.429805
#15 0.959   0/76 [>---------------------------]   0%
2025-Oct-06 02:23:33.429805
#15 1.091  28/76 [==========>-----------------]  36%
2025-Oct-06 02:23:33.429805
#15 1.196  46/76 [================>-----------]  60%
2025-Oct-06 02:23:33.429805
#15 1.307  64/76 [=======================>----]  84%
2025-Oct-06 02:23:33.429805
#15 1.407  75/76 [===========================>]  98%
2025-Oct-06 02:23:33.429805
#15 1.550  76/76 [============================] 100%
2025-Oct-06 02:23:33.429805
#15 1.819 Generating optimized autoload files
2025-Oct-06 02:23:33.429805
#15 2.728 > Illuminate\Foundation\ComposerScripts::postAutoloadDump
2025-Oct-06 02:23:33.429805
#15 2.736 > @php artisan package:discover --ansi
2025-Oct-06 02:23:33.429805
#15 2.853
2025-Oct-06 02:23:33.429805
#15 2.853    INFO  Discovering packages.
2025-Oct-06 02:23:33.429805
#15 2.853
2025-Oct-06 02:23:33.429805
#15 2.855   laravel/sanctum ....................................................... DONE
2025-Oct-06 02:23:33.429805
#15 2.856   laravel/tinker ........................................................ DONE
2025-Oct-06 02:23:33.429805
#15 2.856   nesbot/carbon ......................................................... DONE
2025-Oct-06 02:23:33.429805
#15 2.856   nunomaduro/termwind ................................................... DONE
2025-Oct-06 02:23:33.429805
#15 2.856
2025-Oct-06 02:23:33.429805
#15 2.865 51 packages you are using are looking for funding.
2025-Oct-06 02:23:33.429805
#15 2.865 Use the `composer fund` command to find out more!
2025-Oct-06 02:23:33.429805
#15 DONE 3.0s
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#16 [stage-0 10/17] COPY --chown=www:www ./frontend /var/www/frontend
2025-Oct-06 02:23:33.429805
#16 DONE 0.0s
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#17 [stage-0 11/17] WORKDIR /var/www/frontend
2025-Oct-06 02:23:33.429805
#17 DONE 0.0s
2025-Oct-06 02:23:33.429805
2025-Oct-06 02:23:33.429805
#18 [stage-0 12/17] RUN npm install && npm run build
2025-Oct-06 02:23:33.429805
#18 2.230 npm warn ERESOLVE overriding peer dependency
2025-Oct-06 02:23:33.429805
#18 2.230 npm warn While resolving: vite-plugin-inspect@0.8.9
2025-Oct-06 02:23:33.429805
#18 2.230 npm warn Found: vite@7.0.6
2025-Oct-06 02:23:33.429805
#18 2.230 npm warn node_modules/vite
2025-Oct-06 02:23:33.429805
#18 2.230 npm warn   dev vite@"^7.0.0" from the root project
2025-Oct-06 02:23:33.429805
#18 2.230 npm warn   7 more (@vitejs/plugin-vue, @vitest/mocker, vite-hot-client, ...)
2025-Oct-06 02:23:33.429805
#18 2.230 npm warn
2025-Oct-06 02:23:33.429805
#18 2.230 npm warn Could not resolve dependency:
2025-Oct-06 02:23:33.429805
#18 2.230 npm warn peer vite@"^3.1.0 || ^4.0.0 || ^5.0.0-0 || ^6.0.1" from vite-plugin-inspect@0.8.9
2025-Oct-06 02:23:33.429805
#18 2.230 npm warn node_modules/vite-plugin-vue-devtools/node_modules/vite-plugin-inspect
2025-Oct-06 02:23:33.429805
#18 2.230 npm warn   vite-plugin-inspect@"0.8.9" from vite-plugin-vue-devtools@7.7.7
2025-Oct-06 02:23:33.429805
#18 2.230 npm warn   node_modules/vite-plugin-vue-devtools
2025-Oct-06 02:23:33.429805
#18 2.230 npm warn
2025-Oct-06 02:23:33.429805
#18 2.230 npm warn Conflicting peer dependency: vite@6.3.6
2025-Oct-06 02:23:33.429805
#18 2.230 npm warn node_modules/vite
2025-Oct-06 02:23:33.429805
#18 2.230 npm warn   peer vite@"^3.1.0 || ^4.0.0 || ^5.0.0-0 || ^6.0.1" from vite-plugin-inspect@0.8.9
2025-Oct-06 02:23:33.429805
#18 2.230 npm warn   node_modules/vite-plugin-vue-devtools/node_modules/vite-plugin-inspect
2025-Oct-06 02:23:33.429805
#18 2.230 npm warn     vite-plugin-inspect@"0.8.9" from vite-plugin-vue-devtools@7.7.7
2025-Oct-06 02:23:33.429805
#18 2.230 npm warn     node_modules/vite-plugin-vue-devtools
2025-Oct-06 02:23:33.429805
#18 5.651
2025-Oct-06 02:23:33.429805
#18 5.651 added 467 packages, and audited 468 packages in 6s
2025-Oct-06 02:23:33.429805
#18 5.651
2025-Oct-06 02:23:33.429805
#18 5.651 127 packages are looking for funding
2025-Oct-06 02:23:33.429805
#18 5.651   run `npm fund` for details
2025-Oct-06 02:23:33.429805
#18 5.656
2025-Oct-06 02:23:33.429805
#18 5.656 2 vulnerabilities (1 low, 1 high)
2025-Oct-06 02:23:33.429805
#18 5.656
2025-Oct-06 02:23:33.429805
#18 5.656 To address all issues, run:
2025-Oct-06 02:23:33.429805
#18 5.656   npm audit fix
2025-Oct-06 02:23:33.429805
#18 5.656
2025-Oct-06 02:23:33.429805
#18 5.656 Run `npm audit` for details.
2025-Oct-06 02:23:33.429805
#18 5.843
2025-Oct-06 02:23:33.429805
#18 5.843 > rintegra@0.0.0 build
2025-Oct-06 02:23:33.429805
#18 5.843 > run-p type-check "build-only {@}" --
2025-Oct-06 02:23:33.429805
#18 5.843
2025-Oct-06 02:23:33.429805
#18 6.041
2025-Oct-06 02:23:33.429805
#18 6.041 > rintegra@0.0.0 type-check
2025-Oct-06 02:23:33.429805
#18 6.041 > vue-tsc --build
2025-Oct-06 02:23:33.429805
#18 6.041
2025-Oct-06 02:23:33.429805
#18 6.050
2025-Oct-06 02:23:33.429805
#18 6.050 > rintegra@0.0.0 build-only
2025-Oct-06 02:23:33.429805
#18 6.050 > vite build
2025-Oct-06 02:23:33.429805
#18 6.050
2025-Oct-06 02:23:33.429805
#18 6.752 vite v7.0.6 building for production...
2025-Oct-06 02:23:33.429805
#18 6.844 transforming...
2025-Oct-06 02:23:33.429805
#18 11.79 ✓ 683 modules transformed.
2025-Oct-06 02:23:33.429805
#18 13.35 rendering chunks...
2025-Oct-06 02:23:33.429805
#18 16.37 src/components/admin/ContainerBlockEditor.vue(102,36): error TS18048: '__VLS_ctx.localBlock.backgroundGradient' is possibly 'undefined'.
2025-Oct-06 02:23:33.429805
#18 16.37 src/components/admin/ContainerBlockEditor.vue(107,36): error TS18048: '__VLS_ctx.localBlock.backgroundGradient' is possibly 'undefined'.
2025-Oct-06 02:23:33.429805
#18 16.37 src/components/admin/ContainerBlockEditor.vue(117,36): error TS18048: '__VLS_ctx.localBlock.backgroundGradient' is possibly 'undefined'.
2025-Oct-06 02:23:33.429805
#18 16.37 src/components/admin/ContainerBlockEditor.vue(122,36): error TS18048: '__VLS_ctx.localBlock.backgroundGradient' is possibly 'undefined'.
2025-Oct-06 02:23:33.429805
#18 16.37 src/components/admin/ContainerBlockEditor.vue(132,53): error TS18048: '__VLS_ctx.localBlock.backgroundGradient' is possibly 'undefined'.
2025-Oct-06 02:23:33.429805
#18 16.37 src/components/admin/GlobalConfigContent.vue(57,26): error TS7016: Could not find a declaration file for module '@/components/admin/HeaderConfig.vue'. '/var/www/frontend/src/components/admin/HeaderConfig.vue' implicitly has an 'any' type.
2025-Oct-06 02:23:33.429805
#18 16.37 src/components/admin/GlobalConfigContent.vue(58,26): error TS7016: Could not find a declaration file for module '@/components/admin/FooterConfig.vue'. '/var/www/frontend/src/components/admin/FooterConfig.vue' implicitly has an 'any' type.
2025-Oct-06 02:23:33.429805
#18 16.37 src/components/admin/GlobalConfigContent.vue(61,27): error TS7016: Could not find a declaration file for module '@/components/admin/GlobalsConfig.vue'. '/var/www/frontend/src/components/admin/GlobalsConfig.vue' implicitly has an 'any' type.
2025-Oct-06 02:23:33.429805
#18 16.37 src/components/blocks/BlockRenderer.vue(44,8): error TS2322: Type 'Block' is not assignable to type 'TextBlock | SpacerBlock | BannerIntegraBlock | CualidadesBlock | TextoyVideoBlock | ContainerBlock | ... 4 more ... | LeadConverterBlock'.
2025-Oct-06 02:23:33.429805
#18 16.37   Type 'HeroBlock' is not assignable to type 'TextBlock | SpacerBlock | BannerIntegraBlock | CualidadesBlock | TextoyVideoBlock | ContainerBlock | ... 4 more ... | LeadConverterBlock'.
2025-Oct-06 02:23:33.429805
#18 16.37     Type 'HeroBlock' is missing the following properties from type 'BannerIntegraBlock': backgroundImageOpacity, personImage, titleColor, descriptionColor
2025-Oct-06 02:23:33.429805
#18 16.38 src/components/blocks/ServicesBlock.vue(99,69): error TS2345: Argument of type 'Element | ComponentPublicInstance<{}, {}, {}, {}, {}, {}, {}, {}, false, ComponentOptionsBase<any, any, any, any, any, any, any, any, any, {}, {}, string, {}, {}, {}, string, ComponentProvideOptions>, ... 4 more ..., any> | null' is not assignable to parameter of type 'HTMLElement | null'.
2025-Oct-06 02:23:33.429805
#18 16.38   Type 'Element' is missing the following properties from type 'HTMLElement': accessKey, accessKeyLabel, autocapitalize, dir, and 126 more.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(376,38): error TS2339: Property 'columns' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'columns' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(377,17): error TS2339: Property 'columns' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'columns' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(377,37): error TS2339: Property 'columns' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'columns' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(387,17): error TS2339: Property 'columnsCount' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'columnsCount' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(387,42): error TS2339: Property 'columns' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'columns' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(388,83): error TS2339: Property 'columnsCount' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'columnsCount' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(388,119): error TS2339: Property 'columns' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'columns' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(393,17): error TS2339: Property 'items' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'items' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(393,35): error TS2339: Property 'items' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'items' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(394,21): error TS2339: Property 'items' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'items' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(395,19): error TS2339: Property 'items' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'items' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(395,37): error TS2339: Property 'items' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'items' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(400,78): error TS2339: Property 'items' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'items' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(405,17): error TS2339: Property 'members' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'members' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(405,37): error TS2339: Property 'members' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'members' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(406,21): error TS2339: Property 'members' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'members' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(407,19): error TS2339: Property 'members' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'members' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(407,39): error TS2339: Property 'members' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'members' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(413,69): error TS2339: Property 'members' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'members' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(418,17): error TS2339: Property 'services' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'services' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(418,38): error TS2339: Property 'services' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'services' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(419,21): error TS2339: Property 'services' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'services' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(420,19): error TS2339: Property 'services' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'services' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(420,40): error TS2339: Property 'services' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'services' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(425,73): error TS2339: Property 'services' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'services' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(431,17): error TS2339: Property 'valueStackItems' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'valueStackItems' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(431,46): error TS2339: Property 'valueStackItems' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'valueStackItems' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(437,17): error TS2339: Property 'urgencyItems' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'urgencyItems' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(437,43): error TS2339: Property 'urgencyItems' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'urgencyItems' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(443,17): error TS2339: Property 'trustItems' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'trustItems' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/composables/useBlockTemplates.ts(443,41): error TS2339: Property 'trustItems' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; } | ... 13 more ... | { ...; }'.
2025-Oct-06 02:23:33.429805
#18 16.38   Property 'trustItems' does not exist on type '{ type?: "hero" | undefined; title?: string | undefined; subtitle?: string | undefined; description?: string | undefined; backgroundImage?: string | undefined; backgroundType?: "image" | "gradient" | "solid" | undefined; ... 13 more ...; customCSS: string; }'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/router/index.ts(5,24): error TS7016: Could not find a declaration file for module '@/components/Layout/MainLayout.vue'. '/var/www/frontend/src/components/Layout/MainLayout.vue' implicitly has an 'any' type.
2025-Oct-06 02:23:33.429805
#18 16.38 src/router/index.ts(11,23): error TS7016: Could not find a declaration file for module '@/views/auth/LoginView.vue'. '/var/www/frontend/src/views/auth/LoginView.vue' implicitly has an 'any' type.
2025-Oct-06 02:23:33.429805
#18 16.38 src/router/index.ts(12,26): error TS7016: Could not find a declaration file for module '@/views/auth/RegisterView.vue'. '/var/www/frontend/src/views/auth/RegisterView.vue' implicitly has an 'any' type.
2025-Oct-06 02:23:33.429805
#18 16.38 src/router/index.ts(15,28): error TS7016: Could not find a declaration file for module '@/views/admin/AdminDashboard.vue'. '/var/www/frontend/src/views/admin/AdminDashboard.vue' implicitly has an 'any' type.
2025-Oct-06 02:23:33.429805
#18 16.38 src/stores/auth.ts(58,39): error TS2345: Argument of type 'string | null' is not assignable to parameter of type 'string'.
2025-Oct-06 02:23:33.429805
#18 16.38   Type 'null' is not assignable to type 'string'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/stores/auth.ts(64,22): error TS18046: 'error' is of type 'unknown'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/stores/auth.ts(82,39): error TS2345: Argument of type 'string | null' is not assignable to parameter of type 'string'.
2025-Oct-06 02:23:33.429805
#18 16.38   Type 'null' is not assignable to type 'string'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/stores/auth.ts(88,22): error TS18046: 'error' is of type 'unknown'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/stores/auth.ts(124,13): error TS18046: 'error' is of type 'unknown'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/stores/auth.ts(140,39): error TS2345: Argument of type 'string | null' is not assignable to parameter of type 'string'.
2025-Oct-06 02:23:33.429805
#18 16.38   Type 'null' is not assignable to type 'string'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/stores/content.ts(99,25): error TS7006: Parameter 'contentData' implicitly has an 'any' type.
2025-Oct-06 02:23:33.429805
#18 16.38 src/stores/content.ts(103,11): error TS2532: Object is possibly 'undefined'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/stores/content.ts(112,25): error TS7006: Parameter 'id' implicitly has an 'any' type.
2025-Oct-06 02:23:33.429805
#18 16.38 src/stores/content.ts(112,29): error TS7006: Parameter 'contentData' implicitly has an 'any' type.
2025-Oct-06 02:23:33.429805
#18 16.38 src/stores/content.ts(116,25): error TS2532: Object is possibly 'undefined'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/stores/content.ts(118,13): error TS2532: Object is possibly 'undefined'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/stores/content.ts(128,25): error TS7006: Parameter 'id' implicitly has an 'any' type.
2025-Oct-06 02:23:33.429805
#18 16.38 src/stores/content.ts(132,39): error TS2532: Object is possibly 'undefined'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/stores/content.ts(140,30): error TS7006: Parameter 'contents' implicitly has an 'any' type.
2025-Oct-06 02:23:33.429805
#18 16.38 src/stores/content.ts(144,11): error TS2532: Object is possibly 'undefined'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/views/DynamicPageView.vue(34,25): error TS7016: Could not find a declaration file for module '@/components/PageContent.vue'. '/var/www/frontend/src/components/PageContent.vue' implicitly has an 'any' type.
2025-Oct-06 02:23:33.429805
#18 16.38 src/views/DynamicPageView.vue(67,9): error TS18046: 'err' is of type 'unknown'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/views/DynamicPageView.vue(109,34): error TS2339: Property 'meta_description' does not exist on type 'never'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/views/DynamicPageView.vue(110,31): error TS2339: Property 'title' does not exist on type 'never'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/views/DynamicPageView.vue(116,47): error TS2339: Property 'meta_keywords' does not exist on type 'never'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/views/DynamicPageView.vue(123,51): error TS2339: Property 'featured_image' does not exist on type 'never'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/views/DynamicPageView.vue(130,52): error TS2339: Property 'featured_image' does not exist on type 'never'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/views/admin/BlockEditorPage.vue(136,38): error TS18046: 'error' is of type 'unknown'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/views/admin/BlockEditorPage.vue(140,9): error TS18046: 'error' is of type 'unknown'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/views/admin/BlockEditorPage.vue(141,22): error TS18046: 'error' is of type 'unknown'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/views/admin/BlockEditorPage.vue(142,16): error TS18046: 'error' is of type 'unknown'.
2025-Oct-06 02:23:33.429805
#18 16.38 src/views/admin/BlockEditorPage.vue(143,36): error TS18046: 'error' is of type 'unknown'.
2025-Oct-06 02:23:33.429805
#18 16.80 ERROR: "type-check" exited with 2.
2025-Oct-06 02:23:33.429805
#18 ERROR: process "/bin/sh -c npm install && npm run build" did not complete successfully: exit code: 1
2025-Oct-06 02:23:33.429805
------
2025-Oct-06 02:23:33.429805
> [stage-0 12/17] RUN npm install && npm run build:
2025-Oct-06 02:23:33.429805
16.38 src/views/DynamicPageView.vue(110,31): error TS2339: Property 'title' does not exist on type 'never'.
2025-Oct-06 02:23:33.429805
16.38 src/views/DynamicPageView.vue(116,47): error TS2339: Property 'meta_keywords' does not exist on type 'never'.
2025-Oct-06 02:23:33.429805
16.38 src/views/DynamicPageView.vue(123,51): error TS2339: Property 'featured_image' does not exist on type 'never'.
2025-Oct-06 02:23:33.429805
16.38 src/views/DynamicPageView.vue(130,52): error TS2339: Property 'featured_image' does not exist on type 'never'.
2025-Oct-06 02:23:33.429805
16.38 src/views/admin/BlockEditorPage.vue(136,38): error TS18046: 'error' is of type 'unknown'.
2025-Oct-06 02:23:33.429805
16.38 src/views/admin/BlockEditorPage.vue(140,9): error TS18046: 'error' is of type 'unknown'.
2025-Oct-06 02:23:33.429805
16.38 src/views/admin/BlockEditorPage.vue(141,22): error TS18046: 'error' is of type 'unknown'.
2025-Oct-06 02:23:33.429805
16.38 src/views/admin/BlockEditorPage.vue(142,16): error TS18046: 'error' is of type 'unknown'.
2025-Oct-06 02:23:33.429805
16.38 src/views/admin/BlockEditorPage.vue(143,36): error TS18046: 'error' is of type 'unknown'.
2025-Oct-06 02:23:33.429805
16.80 ERROR: "type-check" exited with 2.
2025-Oct-06 02:23:33.429805
------
2025-Oct-06 02:23:33.429805
Dockerfile:59
2025-Oct-06 02:23:33.429805
--------------------
2025-Oct-06 02:23:33.429805
57 |     COPY --chown=www:www ./frontend /var/www/frontend
2025-Oct-06 02:23:33.429805
58 |     WORKDIR /var/www/frontend
2025-Oct-06 02:23:33.429805
59 | >>> RUN npm install && npm run build
2025-Oct-06 02:23:33.429805
60 |
2025-Oct-06 02:23:33.429805
61 |     # Mover build de Vue al public de Laravel
2025-Oct-06 02:23:33.429805
--------------------
2025-Oct-06 02:23:33.429805
ERROR: failed to build: failed to solve: process "/bin/sh -c npm install && npm run build" did not complete successfully: exit code: 1
2025-Oct-06 02:23:33.429805
exit status 1
2025-Oct-06 02:23:33.447884
Deployment failed. Removing the new version of your application.
2025-Oct-06 02:23:33.817578
Gracefully shutting down build container: ukcg0ooccc8w8kwwwssg000o