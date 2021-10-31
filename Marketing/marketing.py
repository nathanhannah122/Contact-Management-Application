# imports all requires functions
import matplotlib.pyplot as plt
import numpy as np
import csv
from collections import Counter
import pandas as pd


# function gets CSV data about browser and plots to pie chart
def browser_analysis():
    # goes through data, adds a count for each name
    with open('marketing.csv', 'r') as f:
        c = Counter(row[3] for row in csv.reader(f))

    chrome = c['Chrome']
    opera = c['Opera']
    safari = c['Safari']
    firefox = c['Firefox']
    msie = c['Internet Explorer']
    unknown = c['Unknown']
    edge = c['Edge']


    print('Amount of data \n\rChrome:', chrome)
    print('Opera:', opera)
    print('Safari: ', safari)
    print('Edge: ', edge)
    print('Firefox: ', firefox)
    print('Internet Explorer:', msie)
    print('Unknown:', unknown)


    # plots data to pie chart
    y = np.array([chrome, opera, safari, firefox, msie, unknown])
    mylabels = ["Chrome", "Opera", "Safari", "Firefox", "Internet Explorer", "Unknown"]
    plt.pie(y, labels = mylabels, startangle = 90)  # adds labels to diagram
    plt.legend()
    plt.show()


# function gets CSV data about time taken and plots to pie chart
def screentime():
    # opens CSV with data
    with open('marketing.csv', newline='') as csvfile:
        data = csv.DictReader(csvfile)
        zero_ten = 0
        ten_twenty = 0
        twenty_thirty = 0
        unknown = 0
        print('----SCREEN TIME----')
        # iterates through data, adds to vaariable based on numeric value
        for row in data:
            temptime = row['time']
            # prints each value
            print(temptime)
            temptime = float(temptime)
            if temptime < 10:
                zero_ten = zero_ten + 1
            elif temptime > 10 and temptime < 20:
                ten_twenty = ten_twenty + 1
            elif temptime > 20 and temptime < 30:
                twenty_thirty = twenty_thirty + 1
            else:
                unknown = unknown + 1


        column_names = ["height", "width", "time", "browser"]
        df = pd.read_csv("marketing.csv", names=column_names)
        times = df.time.to_list()
        times.pop(0)
        times = [float(i) for i in times]
        minimum = min(times)
        print("miminum time", minimum)
        maxi = max(times)
        print("maximum time", maxi)
        total = sum(times)
        length = len(times)
        average = total/length
        print("the average time is", average)
        # uses matplotlib.pyplot to plot chart
        y = np.array([zero_ten, ten_twenty, twenty_thirty, unknown])
        mylabels = ["0-10", "10-20", "20-30", "Unknown"]
        plt.pie(y, labels = mylabels, startangle = 90)
        plt.legend()
        plt.show()


# function gets CSV data from width and height and plots to pie chart
def screendimensions():
    #opens CSV with data
    last = None
    dimensioncount = 0
    other = 0
    with open('marketing.csv', newline='') as csvfile:
        data = csv.DictReader(csvfile)
        # iterates through data, adds to variable based on numeric value
        print('----SCREEN RESOLUTIONS----')
        for row in data:
            height = row['height']
            width = row['width']
            print(height, width)
            dimension = height + " x " + width
            if last is not None and dimension != last:
                other = other + 1
            else:
                dimensioncount = dimensioncount + 1
            last = dimension

        y = np.array([dimensioncount, other])
        mylabels = [dimension, "other"]
        plt.pie(y, labels = mylabels, startangle = 90)
        plt.legend()
        plt.show()




# prints out title
print('----SALTAIRE SPORTS MARKETING DEPT.----')
config = True
# while loop until correct input is recieved
while config:
    # try & except to handle user error
    try:
        question = int(input('Please select an option\n\r 1. See Browser Data \n\r 2. See Screen data \n\r 3. See Time data \n\r '))
        if question == 1:
            browser_analysis()
            config = False
        elif question == 2:
            screendimensions()
            config = False
        elif question == 3:
             screentime()
             config = False
        else:
            raise ValueError
    except Exception:
        print('ERROR! Enter valid response ')

# end
