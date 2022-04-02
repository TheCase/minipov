FROM richarvey/nginx-php-fpm:2.0.5

ADD https://dl.dafont.com/dl/?f=04b_08 /tmp/04b_08.zip
ADD https://dl.dafont.com/dl/?f=bitdust_two /tmp/bitdust.zip
ADD https://dl.dafont.com/dl/?f=bit_trip7 /tmp/bit_trip7.zip
ADD https://dl.dafont.com/dl/?f=pixelmix /tmp/pixelmix.zip
ADD https://dl.dafont.com/dl/?f=silkscreen /tmp/silkscreen.zip

RUN mkdir /fonts 
RUN cd /tmp && \
    unzip -j 04b_08.zip 04B_08__.TTF -d /fonts && \
    unzip -j bitdust.zip bitdust2.ttf -d /fonts && \
    unzip -j bit_trip7.zip BitTrip7\(sRB\).TTF -d /fonts && \
    unzip -j pixelmix.zip pixelmix.ttf -d /fonts && \
    unzip -j silkscreen.zip slkscr.ttf -d /fonts && \
    mv /fonts/04B_08__.TTF /fonts/04b_08.ttf && \
    mv /fonts/BitTrip7\(sRB\).TTF /fonts/bittrip7.ttf && \
    chmod 644 /fonts/*.ttf

RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
    docker-php-ext-install -j$(nproc) gd

COPY php /var/www/html
