<?php

	function is_logged_in() {
		if (!isset($_SESSION["username"])) return false;
		return true;
	}

	function require_login() {
		if (!is_logged_in()) die_with_code(403);
	}

	function push_user_session($uid, $username, $email, $alias, $avatar) {
		$_SESSION["uid"] = $uid;
		$_SESSION["username"] = $username;
		$_SESSION["email"] = $email;
		$_SESSION["alias"] = $alias;
		$_SESSION["avatar"] = $avatar;
	}

	function check_user_existence($username, $email, $alias) {
		try {
			$q = new SQLStatement;
			$q->select("username, email, alias")
			  ->from("user")
			  ->where("username = ? OR email = ? OR alias = ?", [$username, $email, $alias])
			  ->execute();
			if ($q->rowCount() != 0) {
				$r = $q->fetch();
				if ($username == $r["username"]) die_in_json("failed", "来晚咯，用户名被人家捎走了哦");
				if ($email == $r["email"]) die_in_json("failed", "你不够特立独行哦，邮箱已经被注册啦");
				if ($alias == $r["alias"]) die_in_json("failed", "你的昵称不够酷炫，跟别人重了哦");
			}
		} catch (Exception $ex) {
			die_in_json("failed", $ex->getMessage());
		}
	}

	function check_sensitive_words(...$content) {
		// TODO
	}

	function is_admin() {
		// TODO
		return false;
	}

	function is_category_owner($cid) {
		$q = new SQLStatement;
		$q->select("owner")
		  ->from("category")
		  ->where("id = ?", $cid, PDO::PARAM_INT)
		  ->execute();
		if ($q->rowCount() < 1) return false;
		$r = $q->fetch()["owner"];
		if ($r == $_SESSION["username"]) return true;
		return false;
	}

	function is_topic_owner($cid, $tid) {
		$q = new SQLStatement;
		$q->select("author")
		  ->from("category_{$cid}")
		  ->where("id = ?", $tid, PDO::PARAM_INT)
		  ->execute();
		if ($q->rowCount() < 1) return false;
		$r = $q->fetch()["author"];
		if ($r == $_SESSION["username"]) return true;
		return false;
	}

	function is_topic_reply_owner($cid, $tid, $rid) {
		$q = new SQLStatement;
		$q->select("author")
		  ->from("category_{$cid}_{$tid}")
		  ->where("id = ?", $rid, PDO::PARAM_INT)
		  ->execute();
		if ($q->rowCount() < 1) return false;
		$r = $q->fetch()["author"];
		if ($r == $_SESSION["username"]) return true;
		return false;
	}
?>
