# symfony

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/574006a8f5534e238161afa9ca6d531c)](https://app.codacy.com/app/LykaJ/symfony?utm_source=github.com&utm_medium=referral&utm_content=LykaJ/symfony&utm_campaign=Badge_Grade_Settings)


# Installation

## Steps

1. **Clone** or **Download** the project.
2. Open the project in your IDE/text editor.
3. Find the file **.env** and edit the followings: <br/>
  a. **DATABASE_URL=** edit to match your database <br/>
  b. **MAILER_URL=** edit to match your email server <br/>
  c. **APP_ENV=** edit as such APP_ENV=dev <br/>
  d. **APP_DEBUG=0** remove this line <br/>
4. Start the server by typing this line in your terminal *php bin/console server:start*
5. Follow this link: http://127.0.0.1:8000/ (the link may differ depending on your configuration.)
6. Run the following command to add the fixtures: `php bin/console doctrine:fixtures:load`
7. Navigate through the website.

 
