from flask import Flask, send_file

app = Flask(__name__)

@app.route('/')
def index():
    return send_file('index.html')

@app.route('/order')
def order():
    return send_file('order.html')

@app.route('/login')
def login():
    return send_file('login.html')


@app.route('/register')
def register():
    return send_file('register.html')

if __name__ == '__main__':
    app.run(host='127.0.0.1', port=888)
