require('dotenv').config();
const express = require('express');
const path = require('path');
const bodyParser = require('body-parser');
const { createHandler } = require('graphql-http/lib/use/express');
const { createServer } = require('http');
const schema = require('./graphql/schema');

// Підключення до MongoDB
require('./config/db');

const ApiRoutes = require('./routes/ApiRoutes');
const WebRoutes = require('./routes/WebRoutes');

const app = express();
const PORT = process.env.PORT || 3000;

// Налаштування EJS
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');

// Статичні файли (styles.css)
app.use(express.static(path.join(__dirname, '..', 'public')));

// Body parser
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

// GraphQL endpoint
app.use('/graphql', createHandler({ schema }));

// Додаємо GraphiQL
app.get('/graphiql', (req, res) => {
    res.sendFile(path.join(__dirname, 'views', 'graphiql.html'));
});

// Маршрути
app.use('/api', ApiRoutes);
app.use('/', WebRoutes);

app.listen(PORT, () => console.log(`Server is running on port ${PORT}`));