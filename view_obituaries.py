import mysql.connector
from mysql.connector import Error
from flask import Flask, render_template, request

# Initialize Flask application
app = Flask(__name__)

# Function to establish MySQL connection
def connect_to_database():
    try:
        conn = mysql.connector.connect(
            host='localhost',
            database='obituary_platform',
            user='your_username',  # Replace with your MySQL username
            password='your_password'  # Replace with your MySQL password
        )
        if conn.is_connected():
            print('Connected to MySQL database')
            return conn
    except Error as e:
        print(e)
        return None

# Route to display obituaries
@app.route('/')
def display_obituaries():
    conn = connect_to_database()
    if conn:
        cursor = conn.cursor(dictionary=True)
        try:
            cursor.execute("SELECT * FROM obituaries")
            obituaries = cursor.fetchall()
            return render_template('view_obituaries.html', obituaries=obituaries)
        except Error as e:
            print(e)
        finally:
            cursor.close()
            conn.close()
    return "Error fetching obituaries"

if __name__ == '__main__':
    app.run(debug=True)
