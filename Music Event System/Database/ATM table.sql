CREATE TABLE ATM (
TransID			int			NOT NULL,
UserID			Int			NOT NULL,
Amount			DECIMAL		NOT NULL,
TransDate		DATE		NOT NULL,

CONSTANT		UserPK		UNIQUE (UserID)
)