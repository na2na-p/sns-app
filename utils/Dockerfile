FROM node:18-bullseye

WORKDIR /app

COPY . ./

RUN apt-get update && apt-get install --no-install-recommends -y chromium tini \
	&& apt-get autoremove -y && apt-get clean -y && rm -rf /var/lib/apt/lists/* /root/.gnupg /tmp/library-scripts

RUN yarn install

ENTRYPOINT ["/usr/bin/tini", "--"]
