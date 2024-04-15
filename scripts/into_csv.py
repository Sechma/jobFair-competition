#!/usr/bin/env python3
import csv


input_filename = 'result.txt'
output_filename = 'contacts_clean.csv'

seen_emails = set()

with open(input_filename, 'r', encoding='utf-8') as infile, \
     open(output_filename, 'w', newline='', encoding='utf-8') as outfile:
    
    writer = csv.writer(outfile)
    writer.writerow(['Name', 'Email'])

    for line in infile:
        parts = line.strip().split(', ')
        if len(parts) == 2:
            name = parts[0].split(': ')[1]
            email = parts[1].split(': ')[1]
            
            if email not in seen_emails:
                seen_emails.add(email)
                writer.writerow([name, email])

print(f'Data has been written to {output_filename}')
