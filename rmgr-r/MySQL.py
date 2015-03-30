#!/usr/bin/env python
# -*- coding:UTF-8 -*-
# made by likunxiang

import MySQLdb
import sys
import mgr_err_describe

class MySQL(object):
    """
    MySQL
    """
    conn = None
    cursor = None

    def __init__(self, host, user, password, db, charset = 'utf8'):
        """MySQL Database initialization """
        self.conn_error = True
        self.host = host
        self.user = user
        self.passwd = password
        self.db = db
        self.charset = charset
        self.cursor = None
        self.__myconnect__()

    def __myset_conn_error(self, e):
        if e.args[0] == 2006 or e.args[0] == 2003:
            self.conn_error = True
            mgr_err_describe.g_err_desc.add_db_error(mgr_err_describe.ErrInfo.db_desc_lose)

    def __myconnect__(self):
        try:
            print >> sys.stderr,  'host[%s], user[%s], passwd[%s], db[%s]' % (self.host, self.user, self.passwd, self.db)
            if self.db == '':
                if self.cursor:
                    self.cursor.close()
                if self.conn:
                    self.conn.close()
                self.conn = MySQLdb.connect(self.host, self.user, self.passwd, port=3306)
            else:
                if self.cursor:
                    self.cursor.close()
                if self.conn:
                    self.conn.close()
                self.conn = MySQLdb.connect(self.host, self.user, self.passwd, self.db, port=3306)
            self.conn_error = False
            mgr_err_describe.g_err_desc.del_db_error(mgr_err_describe.ErrInfo.db_desc_lose)
        except MySQLdb.Error as e:
            print >> sys.stderr,  ('Cannot connect to server\nERROR: ' + repr(e))
            mgr_err_describe.g_err_desc.add_db_error(mgr_err_describe.ErrInfo.db_desc_lose)
            self.conn_error = True
            self.cursor = None
            return

        self.cursor = self.conn.cursor()
        self.cursor.execute('SET NAMES utf8')

    def query_many(self, sql, *values):
        """  Execute many SQL statement """
        try:
            return self.cursor.executemany(sql, values)
        except MySQLdb.Error as e:
            self.__myset_conn_error(e)
        except Exception as e:
            pass

    def query(self, sql, value = None):
        """  Execute SQL statement """
        try:
            return self.cursor.execute(sql, value)
        except MySQLdb.Error as e:
            self.__myset_conn_error(e)
        except Exception as e:
            pass

    def commit(self):
        """  commit db """
        try:
            return self.conn.commit()
        except MySQLdb.Error as e:
            self.__myset_conn_error(e)
        except Exception as e:
            pass

    def seldb(self, db):
        """  select db """
        try:
            return self.conn.select_db(db)
        except MySQLdb.Error as e:
            self.__myset_conn_error(e)
        except Exception as e:
            pass

    def show(self):
        """ Return the results after executing SQL statement """
        try:
            return self.cursor.fetchall()
        except MySQLdb.Error as e:
            self.__myset_conn_error(e)
            return None
        except Exception as e:
            return None

    def nextset(self):
        try:
            return self.cursor.nextset()
        except MySQLdb.Error as e:
            self.__myset_conn_error(e)
            return None
        except Exception as e:
            return None

    def fetch_proc_reset(self):
        try:
            result = self.cursor.fetchall()
            self.cursor.close()
            self.cursor = self.conn.cursor()
            return result
        except MySQLdb.Error as e:
            self.__myset_conn_error(e)
            return None
        except Exception as e:
            return None

    def call_proc(self, proc_name, values):
        """\xe8\xb0\x83\xe7\x94\xa8\xe5\xad\x98\xe5\x82\xa8\xe8\xbf\x87\xe7\xa8\x8b"""
        try:
            self.cursor.callproc(proc_name, values)
        except MySQLdb.Error as e:
            self.__myset_conn_error(e)
            return False
        except Exception as e:
            return False

        return True

    def __myclose__(self):
        """ Terminate the connection """
        try:
            if self.conn:
                self.conn.close()
            if self.cursor:
                self.cursor.close()
        except MySQLdb.Error as e:
            pass
        except Exception as e:
            pass
        finally:
            self.conn_error = True

    def __del__(self):
        """ Terminate the connection """
        self.__myclose__()